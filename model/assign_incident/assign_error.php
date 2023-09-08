<?php include '../view/header.php'; ?>
<main>
    <h1>Error</h1>
    <div class="error-messages">
        <p><?php echo isset($error_message) ? $error_message : 'An error occurred.'; ?></p>
    </div>
    <p><a href="?action=list_incidents">Go Back</a></p>
</main>
<?php include '../view/footer.php'; ?>
