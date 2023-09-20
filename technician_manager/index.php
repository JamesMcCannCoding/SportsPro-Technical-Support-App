<?php
//require('../model/database.php');
//require('../model/technician_db.php');
require('../model/database_oo.php');
require('../model/technician_db_oo.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_technicians';   // Default action when page is loaded.
    }
}
// List Technicians:
if ($action == 'list_technicians') {
    // Get technician data
    //$technicians = get_technicians();
    $technicianDB = new TechnicianDB();
    $technicians = $technicianDB->getTechnicians();

    // Display technician list
    include('technician_list.php');

// Delete technician:    
} else if ($action == 'delete_technician') {
    $technician_id = filter_input(INPUT_POST, 'technician_id');
    echo "Received technician ID: $technician_id";
    // Ensure $technician_id is not empty and contains a valid product code
    if (!empty($technician_id)) {
        // Call the delete_technician function
        $technicianDB = new TechnicianDB();
            if ($technicianDB->delete_technician($technician_id)) {
            // Deletion was successful, you can redirect back to the technician list page
            header("Location: index.php?action=list_technicians");
    }
}
// Shows the technician add form.
} else if ($action == 'add_technician') {
    include('technician_add.php');
} else if ($action == 'submit_technician') {
    // Get data from the form
    $first_name = filter_input(INPUT_POST, 'firstName');
    $last_name = filter_input(INPUT_POST, 'lastName');
    $email = filter_input(INPUT_POST, 'email');
    $phone = filter_input(INPUT_POST, 'phone');
    $password = filter_input(INPUT_POST, 'password');

    // Create a new array to store error messages
    $errors = array();

    // Validate First Name
    if (empty($first_name)) {
        $errors['firstName'] = 'First Name is required.';
    }

    // Validate Last Name
    if (empty($last_name)) {
        $errors['lastName'] = 'Last Name is required.';
    }

    // Validate Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email address is not valid.';
    }

    // Validate Phone
    if (empty($phone)) {
        $errors['phone'] = 'Phone is required.';
    }

    // Validate Password
    if (empty($password)) {
        $errors['password'] = 'Password is required.';
    }

    // If there are validation errors, include the error_page.php file
    if (!empty($errors)) {
        include('technician_error.php');
    } else {
        // All validation passed, proceed with adding the technician
        $technicianDB = new TechnicianDB();
        $addSuccess = $technicianDB->add_technician($first_name, $last_name, $email, $phone, $password);

        if ($addSuccess) {
            // Redirect to the technician list page with a success message
            header('Location: ?action=list_technicians&add_success=true');
        } else {
            // Handle the case where the addition fails
            $errorMessage = "Failed to add the technician.";
            include('technician_error.php');
        }
    }
}
?>
