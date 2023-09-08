<?php include '../view/header.php'; ?>
<main>
    <h1>Assign incident</h1>
    <!-- display the table of currently open incidents -->
    <table>
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Product</th>
            <th>Title</th>
            <th>Opened At</th>
            <th>Technician</th>
        </tr>
        <?php foreach ($incidents as $incident) : ?>
        <tr>
            <td><?php echo htmlspecialchars($incident['incidentID']); ?></td>
            <td><?php echo htmlspecialchars($incident['customer_name']); ?></td>
            <td><?php echo htmlspecialchars($incident['productCode']); ?></td>
            <td><?php echo htmlspecialchars($incident['title']); ?></td>
            <td><?php echo htmlspecialchars($incident['dateOpened']); ?></td>
            <td>
                <form method="post" action="index.php">
                    <select name="techID">
                        <option value="">Select Technician</option>
                        <?php foreach ($technicians as $technician) : ?>
                            <option value="<?php echo $technician['techID']; ?>">
                                <?php echo htmlspecialchars($technician['firstName'] . ' ' . $technician['lastName']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="action" value="assign_technician">
                    <input type="hidden" name="incidentID" value="<?php echo $incident['incidentID']; ?>">
                    <input type="submit" value="Assign">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</main>
<?php include '../view/footer.php'; ?>
