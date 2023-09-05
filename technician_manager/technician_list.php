<?php include '../view/header.php'; ?>
<main>
    <h1>Technician List</h1>
    <?php if (isset($successMessage)): ?>
        <p class="success-message"><?php echo $successMessage; ?></p>
    <?php endif; ?>
    <!-- display a table of technicians -->
    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($technicians as $technician) : ?>
            <tr>
                <td><?php echo $technician['firstName']; ?></td>
                <td><?php echo $technician['lastName']; ?></td>
                <td><?php echo $technician['email']; ?></td>
                <td><?php echo $technician['phone']; ?></td>
                <td><?php echo $technician['password']; ?></td>
                <td>
                    <form method="post" action="?action=delete_technician">
                        <input type="hidden" name="technician_id" value="<?php echo $technician['techID']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="?action=show_add_form">Add Technician</a></p>
</main>
<?php include '../view/footer.php'; ?>