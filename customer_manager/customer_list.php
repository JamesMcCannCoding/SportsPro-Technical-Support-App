<?php include '../view/header.php'; ?>
<main>
    <h2>Customer List</h2>
    <nav>
        <p><a href="index.php?action=search_customers">Search Customers</a></p>
    </nav>
    <?php if (empty($customers)) : ?>
        <p>No customers found.</p>
    <?php else : ?>
        <table>
            <tr>
                <th>Name</th>
                <th>Email Address</th>
                <th>City</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($customers as $customer) : ?>
                <tr>
                    <td><?php echo $customer['firstName'] . ' ' . $customer['lastName']; ?></td>
                    <td><?php echo $customer['email']; ?></td>
                    <td><?php echo $customer['city']; ?></td>
                    <td>
                        <form action="index.php" method="post">
                            <input type="hidden" name="action" value="display_customer">
                            <input type="hidden" name="last_name" value="<?php echo $customer['lastName']; ?>">
                            <input type="submit" value="Select">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</main>
<?php include '../view/footer.php'; ?>
