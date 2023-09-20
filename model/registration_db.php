<?php

function add_registration($customer_id, $product_code) {
    global $db;
    $date = date('Y-m-d H:i:s');  // This gets the current date and time

    $query = 'INSERT INTO registrations (customerID, productCode, registrationDate)
              VALUES (:customer_id, :product_code, :date)';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->bindValue(':product_code', $product_code);
    $statement->bindValue(':date', $date);
    
    $result = $statement->execute();
    $statement->closeCursor();

    return $result;  // This will return true if the insert was successful, and false otherwise.
}
?>
