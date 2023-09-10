<?php include '../view/header.php'; ?>
<main>
    <h2>Customer Search</h2>
    
    <!-- Display a search form at the top -->
    <form action="index.php" method="post">
        <input type="hidden" name="action" value="search_customers">
        
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name">
        <input type="submit" value="Search">
    </form>
    
    <?php if (isset($message)) : ?>
        <p><?php echo $message; ?></p>
    <?php elseif ($customers) : ?>
       
        <!-- Display Customer Details -->
        <h2>Results</h2>
        <?php if ($selected_customer) : ?>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email Address</th>
                    <th>City</th>
                    <th>&nbsp;</th> <!-- Add a column for the Select button -->
                </tr>
                <tr>
                    <td><?php echo $selected_customer['firstName'] . ' ' . $selected_customer['lastName']; ?></td>
                    <td><?php echo $selected_customer['email']; ?></td>
                    <td><?php echo $selected_customer['city']; ?></td>
                    <td>
                        <!-- Add a Select button that links to customer_display page -->
                        <form action="index.php" method="get">
                            <input type="hidden" name="action" value="display_customer">
                            <input type="hidden" name="last_name" value="<?php echo $selected_customer['lastName']; ?>">
                            <input type="submit" value="Select">
                        </form>
                    </td>
                </tr>
            </table>
        <?php else : ?>
            <p>No customer selected.</p>
        <?php endif; ?>
    <?php else : ?>
        <p>No customers found.</p>
    <?php endif; ?>
    <nav>
        <p><a href="index.php">Return to Customer List</a></p>
    </nav>
</main>
<?php include '../view/footer.php'; ?>
