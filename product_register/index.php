<?php
// Start the PHP session to enable the use of session variables.
session_start();

// Uncomment these lines for error reporting in development
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

// Include external files for database connection and functions.
require('../model/database.php');
require('../model/customer_db.php');
require('../model/product_db.php');
require('../model/registration_db.php');

// Retrieve the action from POST request.
$action = filter_input(INPUT_POST, 'action');

// If action is not set using POST, try to get it from GET request.
if (empty($action)) {
    $action = filter_input(INPUT_GET, 'action');
}

// If action is still not set and there's a customer ID in session, default to registering a product.
// If not, default to showing the login form.
if (empty($action)) {
    if (isset($_SESSION['customer_id'])) {
        $action = 'register_product_form';
    } else {
        $action = 'show_login';
    }
}

// Initialize some variables.
$email = '';
$customer = null;
$error_message = '';

// Switch statement to handle different actions.
switch ($action) {
    case 'show_login':
        // Include and display the customer login page.
        include('customer_login.php');
        break;

    case 'login_customer':
        // Retrieve email and password from POST request.
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');

        // Validate user credentials and retrieve customer details
        $customer = get_customer_by_email_password($email, $password);

        // If invalid credentials, show error message and login form again.
        if ($customer === false) {
            $error_message = 'Invalid email or password.';
            include('customer_login.php');
        } else {
            // If valid, set the customer details in session and show product registration form.
            $_SESSION['customer_id'] = $customer['customerID'];
            $_SESSION['email'] = $customer['email'];
            include('product_register.php');
        }
        break;

    case 'register_product_form':
        // Ensure user is logged in before showing the product registration form.
        if (!isset($_SESSION['customer_id']) || is_null($_SESSION['customer_id'])) {
            $error_message = 'Customer information not available. Please log in first.';
            include('register_error.php');
            exit;
        } else {
            include('product_register.php');
            exit;
        }
        break;

    case 'register_product_submit':
        // Retrieve product code from POST request.
        $product_code = filter_input(INPUT_POST, 'productCode');

        // Ensure user is logged in.
        if (!isset($_SESSION['customer_id']) || is_null($_SESSION['customer_id'])) {
            $error_message = 'Customer information not available. Please log in first.';
            include('register_error.php');
            exit;
        }

        // Ensure product code is provided.
        if (empty($product_code)) {
            $error_message = 'Product code is required.';
            include('register_error.php');
            exit;
        }
        
        // Try to register the product for the user.
        try {
            $registration_added = add_registration($_SESSION['customer_id'], $product_code);

            // If registration successful, redirect to success page.
            if ($registration_added) {
                header('Location: register_success.php');
                exit;
            } else {
                $error_message = 'Product registration failed.';
                include('register_error.php');
            }

        } catch (PDOException $e) {
            // Handle database errors.
            if ($e->getCode() == 23000) {
                $error_message = 'This product is already registered for this customer.';
            } else {
                $error_message = 'A database error occurred: ' . $e->getMessage();
            }
            include('register_error.php');
        }
        break;

    default:
        // If action is not recognised, default to showing the login form.
        include('customer_login.php');
        break;
}
?>
