<?php include '../view/header.php'; ?>
<main>
    <!-- display customer information -->
    <h2>View/Update Customer</h2>
    <form action="index.php" method="post" id="aligned">
        <input type="hidden" name="action" value="update_customer">
        <input type="hidden" name="customer_id" value="<?php echo $customer['customerID']; ?>">

        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="<?php echo htmlspecialchars($customer['firstName']); ?>"><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="<?php echo $customer['lastName']; ?>"><br>

        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo $customer['address']; ?>"><br>

        <label for="city">City:</label>
        <input type="text" name="city" value="<?php echo $customer['city']; ?>"><br>

        <label for="state">State:</label>
        <input type="text" name="state" value="<?php echo $customer['state']; ?>"><br>

        <label for="postal_code">Postal Code:</label>
        <input type="text" name="postal_code" value="<?php echo $customer['postalCode']; ?>"><br>

        <label for="country_code">Country:</label>
        <select name="country_code">
            <?php
            $customerCountryCode = $customer['countryCode'];
            $countryOptions = get_countries($customerCountryCode);
            echo $countryOptions;
            ?>
        </select>
        <br>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo $customer['phone']; ?>"><br>

        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo $customer['email']; ?>"><br>

        <label for="password">Password:</label>
        <input type="password" name="password" value="<?php echo $customer['password']; ?>"><br>
        <label>&nbsp;</label>
        <input type="submit" value="Update Customer">
    </form>
    <nav>
        <p><a href="index.php?action=search_customers">Search Customers</a></p>
        <p><a href="index.php?action=list_customers">Back to Customer List</a></p>
    </nav>
</main>
<?php include '../view/footer.php'; ?>
