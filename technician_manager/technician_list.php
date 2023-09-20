<?php include '../view/header.php'; ?>
<main>
    <h1>Technician List</h1>
    <?php if (isset($successMessage)): ?>
        <p class="success-message"><?php echo $successMessage; ?></p>
    <?php endif; ?>
    <!-- display a table of technicians -->
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($technicians as $technician) : ?>
        <tr>
            <td><?php echo $technician->getFullName(); ?></td>
            <td><?php echo $technician->getEmail(); ?></td>
            <td><?php echo $technician->getPhone(); ?></td>
            <td><?php echo $technician->getPassword(); ?></td>
            <td>
                <!-- Delete technicians button -->
                <form method="post" action="?action=delete_technician">
                    <input type="hidden" name="technician_id" value="<?php echo $technician->getTechID(); ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <nav>
        <!-- Add technician button -->
        <p><a href="?action=add_technician">Add Technician</a></p>
    </nav>
</main>
<?php include '../view/footer.php'; ?>
