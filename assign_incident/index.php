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
// Action to assign a technician:
} else if ($action == 'assign_technician') {
    $incidentID = filter_input(INPUT_POST, 'incidentID');
    $techID = filter_input(INPUT_POST, 'techID');

    // Check if a valid technician is selected (you might need to adjust the condition based on the actual default value)
    if (empty($techID) || $techID == "Select Technician") {
        $error_message = 'Invalid option, please select a technician';
        include('assign_error.php');
        exit();
    }

    if ($incidentID && $techID) {
        if (assign_technician($incidentID, $techID)) {
            header('Location: index.php?action=list_incidents'); 
        } else {
            // This block should handle other unexpected database errors, not the selection of an invalid technician.
            $error_message = 'An error occurred while assigning the technician';
            include('assign_error.php');
            exit();
        }
    }
}
?>
