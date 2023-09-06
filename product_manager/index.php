<?php
require('../model/database.php');
require('../model/product_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_products';  // Default action when page is loaded.
    }
}
// List Products:
if ($action == 'list_products') {
    // Get product data
    $products = get_products();
    // Display the product list
    include('product_list.php');

// Delete product:
} else if ($action == 'delete_product') {
    $product_code = filter_input(INPUT_POST, 'product_code');
    // Ensure $product_code is not empty and contains a valid product code.
    if (!empty($product_code)) {
        // Call the delete_product function.
        if (delete_product($product_code)) {
            // Deletion was successful, you can redirect back to the product list page.
            header("Location: index.php?action=list_products");
    }
}
// Shows the product add form.
} else if ($action == 'show_add_form') {
    include('product_add.php');
    
// Product add form validation:
} else if ($action == 'add_product') {
    // Get data from form
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $version = filter_input(INPUT_POST, 'version', FILTER_VALIDATE_FLOAT);
    $release_date = filter_input(INPUT_POST, 'release_date');

    // Create a new array to store error messages:
    $errors = array();
    
    // Validate product code:
    if (empty($code)) {
        $errors['code'] = 'Product code is required.';
    }
    // Validate product name:
    if (empty($name)) {
        $errors['name'] = 'Product name is required';
    }
    // Validate version:
    if (empty($version)) {
        $errors['version'] = 'Product version is required.';
    }
     // Validate release date:
     if (empty($release_date)) {
        $errors['release_date'] = 'Product release date is required.';
    } else {
        // Attempt to convert the user input into a consistent format (e.g., yyyy-mm-dd) using strtotime php function.
        $release_date = strtotime($release_date);
        
        // Check if the date conversion was successful and the date is not the Unix epoch (1/1/1970) using logical or.
        if ($release_date === false || date('Y-m-d', $release_date) == '1970-01-01') {
            // Handle the case where the date input is not valid.
            $errors['release_date'] = 'The date specified is not valid.';
        } else {
            // Convert the valid date to the desired format.
            $release_date = date('Y-m-d', $release_date);
        }
    // Check if the product code already exists:
    $existing_product = get_product($code);
    if ($existing_product) {
        $errors['code'] = 'Product code already exists.';
        } 
    }
    // If there are validation errors, include the product_error.php file.
    if (!empty($errors)) {
        include('product_error.php');
    } else {
        // All validation is passed, proceed with adding the product to mySQL.
        $addSuccess = add_product($code, $name, $version, $release_date);

        if ($addSuccess) {
            // Redirect to the product list.
            header('Location: ?action=list_products&add_success=true');
        } else {
            // Handle the case where the adding fails.
            $errorMessage = "Failed to add the product.";
            include('product_error.php');
        }
    }
}
?>
