<?php
session_start(); // Start the session

if (isset($_POST['action']) && $_POST['action'] === 'logout') {
    // User clicked the "Logout" button, log them out
    session_destroy();
    header('Location: ?action=show_login'); // Redirect to the login page or another page
    exit;
}

?>
