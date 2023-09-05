<?php

function get_technicians() {
    global $db;
    $query = 'SELECT * FROM technicians';

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
    // ??
}
?>