<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<?php include '../view/header.php'; ?>
<main>
    <h2>Register Product</h2>
    
    <?php if (isset($customer)) : ?>
        <p>Customer: <?php echo $customer['firstName'] . ' ' . $customer['lastName']; ?></p>
    <?php endif; ?>

    <?php
    if (isset($registration_success)) {
        echo '<p>' . $registration_success . ' was registered successfully.</p>';
    }
    ?>

    <form action="index.php" method="post" id="aligned">
        <input type="hidden" name="action" value="register_product_submit">
        
        <?php if (isset($customer)) : ?>
            <p>Product: <select name="productCode">
                <?php
                // Fetch a list of products from the database (using functions from product_db.php)
                $products = get_products();

                foreach ($products as $product) {
                    echo '<option value="' . $product['productCode'] . '">' . $product['name'] . '</option>';
                }
                ?>
            </select></p>
            <input type="submit" value="Register Product">
        <?php else : ?>
            <p>Customer information not available. Please log in first.</p>
        <?php endif; ?>
    </form>

    <!-- Display logged in email message -->
    <?php if (isset($_SESSION['email'])) : ?>
        <p>You are logged in as <?php echo $_SESSION['email']; ?></p>
    <?php endif; ?>

    <form action="customer_logout.php" method="post">
        <input type="hidden" name="action" value="logout">
        <input type="submit" value="Logout">
    </form>
</main>
<?php include '../view/footer.php'; ?>
