<?php
require('../model/database.php');
require('../model/incident_db.php');
require('../model/technician_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'list_incidents';  // Default action to list incidents.
    }
}

// List incidents:
if ($action == 'list_incidents') {
    // Retrieve incident data:
    $incidents = get_incidents_assign();
    // Retrieve technicians data:
    $technicians = get_technicians();
    // Display the incidents list:
    include('incident_list.php');
} else if ($action == 'assign_technician') {
    $incidentID = filter_input(INPUT_POST, 'incidentID');
    $techID = filter_input(INPUT_POST, 'techID');

    if ($incidentID && $techID) {
        if (assign_technician($incidentID, $techID)) {
            header('Location: index.php?action=list_incidents'); // Redirect back to the incident list after technician assignment.
        } else {
            $error_message = 'Invalid option, please select a technician';
            include('assign_error.php');
            exit(); // Terminate further execution
        }
    }
}
?>
