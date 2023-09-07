<?php include '../view/header.php'; ?>
<main>
    <h1>Incident List</h1>
    <!-- display the table of currently open incidents -->
    <table>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>product</th>
            <th>Technician</th>
            <th>Opened At</th>
            <th>Action</th>
        </tr>
        <?php foreach ($incidents as $incident) : ?>
        <tr>
            <td><?php echo htmlspecialchars($incident['incidentID']); ?></td>
            <td><?php echo htmlspecialchars($incident['customer_name']); ?></td>
            <td><?php echo htmlspecialchars($incident['productCode']); ?></td>
            <td><?php echo htmlspecialchars($incident['technician_name']); ?></td>
            <td><?php echo htmlspecialchars($incident['dateOpened']); ?></td>
            <td>
                <form action="index.php" method="post">
                    <input type="hidden" name="action" value="complete">
                    <input type="hidden" name="incidentID" value="<?php echo htmlspecialchars($incident['incidentID']); ?>">
                    <input type="submit" value="Complete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>
<?php include '../view/footer.php'; ?>