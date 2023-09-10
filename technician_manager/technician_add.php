<?php include '../view/header.php'; ?>
<main>
    <h1>Add Technician</h1>
    <form action="?action=add_technician" method="post" id="aligned">
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" id="firstName" ><br>

        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" id="lastName" ><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" ><br>

        <label for="phone">Phone:</label>
        <input type="tel" name="phone" id="phone"><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" ><br>

        <input type="submit" value="Add Technician">
    </form>
    <nav>
        <p><a href="?action=list_technicians">View Technician List</a></p>
    </nav>
</main>
<?php include '../view/footer.php'; ?>
