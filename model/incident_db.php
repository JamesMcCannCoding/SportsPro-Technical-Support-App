<?php

function get_incidents_assign() {
    global $db;
    $query = 'SELECT incidents.*, CONCAT(customers.firstName, " ", customers.lastName) AS customer_name, CONCAT(technicians.firstName, " ", technicians.lastName) AS technician_name
              FROM incidents
              INNER JOIN customers ON incidents.customerID = customers.customerID
              LEFT JOIN technicians ON incidents.techID = technicians.techID
              WHERE (incidents.dateClosed IS NULL OR incidents.dateClosed = "") AND incidents.techID IS NULL
              ORDER BY incidents.dateOpened ASC'; 
    $statement = $db->prepare($query);
    $statement->execute();
    $incidents = $statement->fetchAll();
    $statement->closeCursor();
    return $incidents;
}

//Get incidents function.
function get_incidents() {
    global $db;
    $query = 'SELECT incidents.*, CONCAT(customers.firstName, " ", customers.lastName) AS customer_name, CONCAT(technicians.firstName, " ", technicians.lastName) AS technician_name
              FROM incidents
              INNER JOIN customers ON incidents.customerID = customers.customerID
              LEFT JOIN technicians ON incidents.techID = technicians.techID
              WHERE incidents.dateClosed IS NULL OR incidents.dateClosed = ""
              ORDER BY incidents.dateOpened ASC';
    $statement = $db->prepare($query);
    $statement->execute();
    $incidents = $statement->fetchAll();
    $statement->closeCursor();
    return $incidents;
}

// Function to complete an incident by setting the dateClosed.
function complete_incident($incidentID) {
    global $db;
    // Set the current date and time as the dateClosed.
    $dateClosed = date('Y-m-d H:i:s');
    // Define the SQL query to update the incident:
    $query = 'UPDATE incidents
              SET dateClosed = :dateClosed
              WHERE incidentID = :incidentID';
    // Prepare and execute the query:
    $statement = $db->prepare($query);
    $statement->bindValue(':dateClosed', $dateClosed);
    $statement->bindValue(':incidentID', $incidentID);
    $statement->execute();
    $statement->closeCursor();
}

// Function to insert a new incident into the database
function add_incident($firstName, $lastName, $productName, $title, $description) {
    global $db;
    // Get customerID based on firstName and lastName.
    $customerID = get_customer_id_by_name($firstName, $lastName);
    // Get productCode based on productName.
    $productCode = get_product_code_by_name($productName);
    // Set the technician ID.
    $techID = 1;
    // Set the current date as the opened date.
    $dateOpened = date('Y-m-d');
    // Set the dateClosed to null initially.
    $dateClosed = null;
    // Define the SQL query:
    $query = 'INSERT INTO incidents
                 (customerID, productCode, techID, dateOpened, dateClosed, title, description)
              VALUES
                 (:customerID, :productCode, :techID, :dateOpened, :dateClosed, :title, :description)';
    // Prepare and execute the query:
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
