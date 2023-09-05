<?php

// Function to insert a new incident into the database
function add_incident($firstName, $lastName, $productName, $title, $description) {
    global $db;

    // Get customerID based on firstName and lastName (You need to implement this function)
    $customerID = get_customer_id_by_name($firstName, $lastName);

    // Get productCode based on productName (You need to implement this function)
    $productCode = get_product_code_by_name($productName);

    // Set the technician ID (You need to fetch this from session or another source)
    $techID = 1;

    // Set the current date as the opened date
    $dateOpened = date('Y-m-d');

    // Set the dateClosed to null initially
    $dateClosed = null;

    // Define the SQL query
    $query = 'INSERT INTO incidents
                 (customerID, productCode, techID, dateOpened, dateClosed, title, description)
              VALUES
                 (:customerID, :productCode, :techID, :dateOpened, :dateClosed, :title, :description)';
    
    // Prepare and execute the query
    $statement = $db->prepare($query);
    $statement->bindValue(':customerID', $customerID);
    $statement->bindValue(':productCode', $productCode);
    $statement->bindValue(':techID', $techID);
    $statement->bindValue(':dateOpened', $dateOpened); // Uncomment this line
    $statement->bindValue(':dateClosed', $dateClosed);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor();
}

?>