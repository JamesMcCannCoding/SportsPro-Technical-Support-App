<?php

function add_registration($customer_id, $product_code, $registration_date) {
    global $db;

    // Prepare the SQL query to insert registered product into registrations into mySQL.
    $query = "INSERT INTO registrations (customerID, productCode, registrationDate)
              VALUES (:customerID, :productCode, NOW())"; 

    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customer_id);
    $statement->bindValue(':productCode', $product_code);
    $statement->bindValue(':registrationDate', $registration_date);
    $result = $statement->execute();
    if ($result) {
        return true; // Registration successful
    } else {
        return false; // Registration failed
    }
}

?>
