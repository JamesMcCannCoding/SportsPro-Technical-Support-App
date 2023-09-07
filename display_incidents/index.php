<?php
require('../model/database.php');
require('../model/incident_db.php');

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
    $incidents = get_incidents();
    // Display the incidents list:
    include('incidents_list.php');
    // Handle the 'complete' action when 'complete' button is pressed.
} else if ($action == 'complete') {
    // Handle the "Complete" button click:
    $incidentID = filter_input(INPUT_POST, 'incidentID');
    if ($incidentID) {
        complete_incident($incidentID); // Call a function to update the incident's dateClosed
        header('Location: index.php?action=list_incidents'); // Redirect back to the incident list after 'complete' pressed.
    }
}
?>
