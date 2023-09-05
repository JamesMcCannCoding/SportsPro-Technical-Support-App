<?php

function add_registration($customer_id, $product_code) {
    global $db;

    // Prepare the SQL query to insert registered product into registrations into mySQL.
    $query = "INSERT INTO registrations (customerID, productCode)
              VALUES (:customerID, :productCode)"; 

    // Create a prepared statement
    $statement = $db->prepare($query);

    // Bind values to placeholders
    $statement->bindValue(':customerID', $customer_id);
    $statement->bindValue(':productCode', $product_code);

    // Execute the statement
    $result = $statement->execute();

    // Check if the registration was successful
    if ($result) {
        return true; // Registration successful
    } else {
        return false; // Registration failed
    }
}
?>