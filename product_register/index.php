<?php
session_start(); // Start the session

require('../model/database.php');
require('../model/customer_db.php');
require('../model/product_db.php');
require('../model/registration_db.php');

// Check if the user is already logged in
if (isset($_SESSION['customer_id'])) {
    // User is already logged in, redirect to the desired page
    if ($_GET['action'] === 'login_customer') {
        // Redirect to a default page
        header('Location: ?action=register_product'); 
        exit;
    }
}

// Instantiate variables
$email = '';
$customer = null; // Initialize the customer variable
$error_message = '';

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = 'show_login'; // Default action to show login form
}

// Instantiate variables
$email = '';
$customer = null; // Initialize the customer variable
$error_message = '';

if ($action == 'show_login') {
    include('customer_login.php'); // Display the login form
    // Search for customer to log in
} else if ($action == 'login_customer') {
    // Handle customer login
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    // Check if the email exists in the database and password is correct
    $customer = get_customer_by_email_password($email, $password);

    if ($customer === false) {
        // Email or password is incorrect, set error message and redirect to error page
        $error_message = 'Invalid email or password.';
        include('customer_login.php');
    } else {
        // Store customer data in the session upon successful login
        $_SESSION['customer_id'] = $customer['customerID'];
        $_SESSION['email'] = $customer['email'];
        // Add other customer data as needed

        // Email and password are correct, pass customer information to product registration
        $action = 'register_product';
        include('product_register.php');
    }


// After successful login, take the customer to register product page
} else if ($action == 'register_product') {
    // Handle product registration
    $product_code = filter_input(INPUT_POST, 'productCode');

    // Ensure that the customer is logged in
    if (!$customer) {
        // Redirect to the login page if the customer is not logged in
        header('Location: ?action=show_login');
        exit;
    }

    // Add the registration to the database
    $registration_added = add_registration($customer['customerID'], $product_code);

    if ($registration_added) {
        // Set a success message with the product code
        header('Location: ?action=register_success&registration_added=true');
        include ('register_success.php');
    } else {
        include ('register_error.php');
        // Handle the case where product registration failed
        // You can set an error message here if needed
        $error_message = 'Product registration failed.';
    }

    // Include the product registration form
    include('product_register.php');
}
?>
