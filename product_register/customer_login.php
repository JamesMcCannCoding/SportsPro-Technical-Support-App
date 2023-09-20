<?php 
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<?php include '../view/header.php'; ?>
<main>
    <!-- Displays the customer log in field. -->
    <h1>Customer Login</h1>
    <p>You must login before you can register a product.</p>
    <!-- Display a login form -->
    <form action="index.php" method="post" class="vertical-form">
        <input type="hidden" name="action" value="login_customer">
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <input type="submit" value="Login">
        </div>
    </form>
    <?php
    // Display error message if email or password is incorrect.
    if (isset($error_message)) {
        echo '<p>' . $error_message . '</p>';
    }
    ?>
</main>
<?php include '../view/footer.php'; ?>
