<?php include '../view/header.php'; ?>
<main>
    <h1>Product List</h1>
    <!-- display a table of products -->
    <table>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Version</th>
            <th>Release Date</th>
            <th>Action</th>
        </tr>
        <?php foreach ($products as $product) : ?>
        <tr>
            <td><?php echo htmlspecialchars($product['productCode']); ?></td>
            <td><?php echo htmlspecialchars($product['name']); ?></td>
            <td><?php echo htmlspecialchars($product['version']); ?></td>
            <td><?php echo htmlspecialchars($product['releaseDate']); ?></td>
            <td>
                <form action="index.php" method="post">
                    <input type="hidden" name="action" value="delete_product">
                    <input type="hidden" name="product_code" value="<?php echo htmlspecialchars($product['productCode']); ?>">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <!-- Link to the Add Product page -->
    <p><a href="index.php?action=show_add_form">Add Product</a></p>
</main>
<?php include '../view/footer.php'; ?>