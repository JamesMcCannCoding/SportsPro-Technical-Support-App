<?php

function get_customers() {
    global $db;
    $query = 'SELECT * FROM customers';
    $statement = $db->prepare($query);
    $statement->execute();
    $customers = $statement->fetchAll();
    $statement->closeCursor();
    return $customers;
}

function get_customers_by_last_name($last_name) {
    global $db;
    $query = 'SELECT * FROM customers WHERE lastName LIKE :last_name';
    $statement = $db->prepare($query);
    $statement->bindValue(':last_name', '%' . $last_name . '%');
    $statement->execute();
    $customers = $statement->fetchAll();
    $statement->closeCursor();
    
    // Check if any customers were found
    if (count($customers) > 0) {
        // Set the selected customer (first one in the list for simplicity)
        global $selected_customer;
        $selected_customer = $customers[0];
        return true;
    } else {
        return false;
    }
}

function get_customer($customer_id) {
    global $db;
    $query = 'SELECT * FROM customers WHERE customerID = :customer_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();
    return $customer;
}

function get_customer_by_email($email) {
    global $db;
    $query = 'SELECT * FROM customers WHERE email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $customer = $statement->fetch();
    $statement->closeCursor();
    return $customer;
}

function delete_customer($customer_id) {
    global $db;
    $query = 'DELETE FROM customers WHERE customerID = :customer_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_customer($first_name, $last_name, $address, $city, $state, $postal_code, $country_code, $phone, $email, $password) {
    global $db;
    $query = 'INSERT INTO customers (firstName, lastName, address, city, state, postalCode, countryCode, phone, email, password)
              VALUES (:first_name, :last_name, :address, :city, :state, :postal_code, :country_code, :phone, :email, :password)';
    $statement = $db->prepare($query);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':address', $address);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':state', $state);
    $statement->bindValue(':postal_code', $postal_code);
    $statement->bindValue(':country_code', $country_code); // Bind country code
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    if ($statement->execute()) {
        return true; // Deletion successful
    } else {
        return false; // Deletion failed
    }
    $statement->closeCursor();
}

function update_customer($customer_id, $first_name, $last_name, $address, $city, $state, $postal_code, $country_code, $phone, $email, $password) {
    global $db;
    $query = 'UPDATE customers
              SET firstName = :first_name, lastName = :last_name, address = :address, 
                  city = :city, state = :state, postalCode = :postal_code, countryCode = :country_code,
                  phone = :phone, email = :email, password = :password
              WHERE customerID = :customer_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->bindValue(':first_name', $first_name);
    $statement->bindValue(':last_name', $last_name);
    $statement->bindValue(':address', $address);
    $statement->bindValue(':city', $city);
    $statement->bindValue(':state', $state);
    $statement->bindValue(':postal_code', $postal_code);
    $statement->bindValue(':country_code', $country_code); // Bind country code
    $statement->bindValue(':phone', $phone);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':password', $password);
    if ($statement->execute()) {
        return true; // Deletion successful
    } else {
        return false; // Deletion failed
    }
    $statement->closeCursor();
}

/*function get_countries() {
    global $db;
    $query = 'SELECT countryCode, countryName FROM countries';
    $statement = $db->prepare($query);
    $statement->execute();
    $countries = $statement->fetchAll();
    $statement->closeCursor();
    return $countries;
}*/

function get_countries($customerCountryCode) {
    global $db;
    $query = 'SELECT countryCode, countryName FROM countries';
    $statement = $db->prepare($query);
    $statement->execute();
    $countries = $statement->fetchAll();
    $statement->closeCursor();

    $options = '';

    foreach ($countries as $country) {
        $countryCode = $country['countryCode'];
        $countryName = $country['countryName'];
        $selected = ($customerCountryCode === $countryCode) ? 'selected' : ''; // Check if it's the selected option
        $options .= "<option value='$countryCode' $selected>$countryName</option>";
    }

    return $options;
}

?>