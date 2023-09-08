<?php 
session_start();
include '../view/header.php'; ?>
<main>
    <h1>Customer Login</h1>
    <p>You must login before you can register a product.</p>
    <!-- Display a login form -->
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="login_customer">
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Login">
    </form>
    <?php
    // Display error message if email or password is incorrect.
    if (isset($error_message)) {
        echo '<p>' . $error_message . '</p>';
    }
    ?>
</main>
<?php include '../view/footer.php'; ?>
