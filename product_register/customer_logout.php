<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<?php if (isset($_POST['action']) && $_POST['action'] === 'logout') {
    // User clicked the "Logout" button, log them out
    session_destroy();
    $_SESSION = array();
    header('Location: index.php?action=show_login');
    exit;
}
?>
