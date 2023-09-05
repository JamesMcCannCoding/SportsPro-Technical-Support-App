<?php include '../view/header.php'; ?>
<main>
    <h1>Get Customer</h1>
        <p>You must enter the customer's email address to select the customer:</p>
        <!-- Display get customer form -->
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="search_customer">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            <input type="submit" value="Get Customer">
        </form>
    <?php
    // Display error message if email does not exist.
    if (isset($error_message)) {
        echo '<p>' . $error_message . '</p>';
    }
    ?>
</main>
<?php include '../view/footer.php'; ?>