<?php

function get_technicians() {
    global $db;
    $query = 'SELECT CONCAT(firstName, " ", lastName) AS name, email, phone, password FROM technicians';

    $statement = $db->prepare($query);
    $statement->execute();
    $technicians = $statement->fetchAll();
    $statement->closeCursor();
    return $technicians;
}


function delete_technician($technician_id) {
    global $db;
    $query = "DELETE FROM technicians WHERE techID = :technician_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':technician_id', $technician_id);
    if ($statement->execute()) {
        return true; // Deletion successful
    } else {
        return false; // Deletion failed
    }
    $statement->closeCursor();
}

function add_technician($first_name, $last_name, $email, $phone, $password) {
    global $db;

    $query = "INSERT INTO technicians (firstName, lastName, email, phone, password)
              VALUES (:firstName, :lastName, :email, :phone, :password)";

    $statement = $db->prepare($query);
    $statement->bindValue(':firstName', $first_name);
    $statement->bindValue(':lastName', $last_name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':password', $password);
    // Technician boolean result for adding
    if ($statement->execute()) {
        return true; // technician adding successful
    } else {
        return false; // Technician adding failed
    }
    $statement->closeCursor();
}

function update_technician($technician_id, $first_name, $last_name, $email, $phone, $password) {
    global $db;

    $query = "UPDATE technicians
              SET firstName = :firstName, lastName = :lastName, email = :email, phone = :phone, password = :password
              WHERE techID = :technician_id";

    $statement = $db->prepare($query);
    $statement->bindValue(':technician_id', $technician_id);
    $statement->bindValue(':firstName', $first_name);
    $statement->bindValue(':lastName', $last_name);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':password', $password);

    // Technician boolean result for updating
    if ($statement->execute()) {
        return true; // Technician update successful
    } else {
        return false; // Technician update failed
    }
    $statement->closeCursor();
}

// Function to assign a technician to an incident
function assign_technician($incidentID, $techID) {
    global $db;
    $query = 'UPDATE incidents
              SET techID = :techID
              WHERE incidentID = :incidentID';
    $statement = $db->prepare($query);
    $statement->bindValue(':techID', $techID);
    $statement->bindValue(':incidentID', $incidentID);
    $statement->execute();
    $statement->closeCursor();
}
?>
