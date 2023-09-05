<?php include '../view/header.php'; ?>
<main>
    <h2>Error</h2>
    <p>An error occurred while processing your request:</p>
    <ul>
        <?php foreach ($errors as $error) : ?>
            <li><?php echo htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    </ul>
    <p>Please go back and correct the following issues:</p>
    <p><a href="index.php?action=display_customer">Back to Customer List</a></p>
</main>
<?php include '../view/footer.php'; ?>