<?php
require('../model/database.php');
require('../model/customer_db.php');
require('../model/technician_db.php');
require('../model/product_db.php');
require('../model/incident_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = 'get_customer'; // Default action to show get customer form
}

// Instantiate variables
$email = '';
$customer = null;
$error_message = '';

if ($action == 'get_customer') {
    include('get_customer.php');
    // Search for customer function
} else if ($action == 'search_customer') {
    // Handle customer search
    $email = filter_input(INPUT_POST, 'email');
    // Check if the email exists in the database
    $customer = get_customer_by_email($email);

    if ($customer === false) {
        $error_message = 'A customer with that email address does not exist.';
        include('get_customer.php');
    } else {
        // Pass the customer to the new incident form
        $action = 'new_incident_form.php';
        include('new_incident_form.php');
    }
    //
} else if ($action == 'create_incident') {
    // Here, you should validate the input fields first
    $productCode = filter_input(INPUT_POST, 'productCode');
    $title = filter_input(INPUT_POST, 'title');
    $description = filter_input(INPUT_POST, 'description');

    // Create a new array to store error messages
    $errors = array();

    // Validate title
    if (empty($title)) {
        $errors['title'] = 'Title is required';
    }

    // Validate description
    if (empty($description)) {
        $errors['description'] = 'Description is required.';
    }

    if (!empty($errors)) {
        include('incident_errors.php');
    } else {
        // All validation passed, proceed with adding the technician
        $addSuccess = add_incident($customerID, $productCode, $techID, $title, $description);

        if ($addSuccess) {
            // Redirect to the technician list page with a success message
            header('Location: ?action=incident_success&add_success=true');
        } else {
            // Handle the case where the addition fails
            $errorMessage = "Failed to add the incident.";
            include('incident_errors.php');
        }
    }
}
?>
