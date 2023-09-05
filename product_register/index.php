<?php
require('../model/database.php');
require('../model/customer_db.php');
require('../model/product_db.php');
require('../model/registration_db.php');

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
    // Check if the email exists in the database
    $customer = get_customer_by_email($email);

    if ($customer === false) {
        // Email not found, set error message and redirect to error page
        $error_message = 'A customer with that email address does not exist.';
        include('customer_login.php');
    } else {
        // Email found, pass customer information to product registration
        $action = 'register_product';
        include('product_register.php');
    }
//
} else if ($action == 'register_product') {
    // Handle product registration
    $product_code = filter_input(INPUT_POST, 'productCode');

    // Add the registration to the database (call the add_registration function)
    $registration_added = add_registration($customer['customerID'], $product_code);

    if ($registration_added) {
        // Set a success message with the product code
        header('Location: ?action=register_success&$registration_added=true');
        include ('register_success.php');
    } else {
        include ('register_error.php');
        // Handle the case where product registration failed
        // You can set an error message here if needed
        $error_message = 'A customer with that email address does not exist.';
    }

    // Include the product registration form
    include('product_register.php');
}
?>
