<?php include '../view/header.php'; ?>
<main>
    <h1>Create Incident</h1>
    <form action="index.php" method="post" id="aligned">
        <input type="hidden" name="action" value="create_incident">
            <?php if (isset($customer)) : ?>
            <p>Customer: <?php echo $customer['firstName'] . ' ' . $customer['lastName']; ?></p>
            <?php endif; ?>
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
        <?php endif; ?>

        <label>Title:</label>
        <input type="text" name="title">
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea>

        <label>&nbsp;</label>
        <br>
        <input type="submit" value="create Incident" /><br>
    </form>
</main>
<?php include '../view/footer.php'; ?>
