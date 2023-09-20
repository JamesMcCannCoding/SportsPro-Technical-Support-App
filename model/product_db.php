<?php

// Get products function.
function get_products() {
    global $db;
    $query = 'SELECT * FROM products
              ORDER BY name';
    $statement = $db->prepare($query);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}

// Get products by customer email function.
function get_products_by_customer($email) {
    global $db;
    $query = 'SELECT products.productCode, products.name 
              FROM products
                INNER JOIN registrations ON products.productCode = registrations.productCode
                INNER JOIN customers ON registrations.customerID = customers.customerID
              WHERE customers.email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $products = $statement->fetchAll();
    $statement->closeCursor();
    return $products;
}

// Get products by product code function.
function get_product($product_code) {
    global $db;
    $query = 'SELECT * FROM products
              WHERE productCode = :product_code';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_code', $product_code);
    $statement->execute();
    $product = $statement->fetch();
    $statement->closeCursor();
    return $product;
}

// Delete products function.
function delete_product($product_code) {
    global $db;
    $query = 'DELETE FROM products
              WHERE productCode = :product_code';
    $statement = $db->prepare($query);
    $statement->bindValue(':product_code', $product_code);
    if ($statement->execute()) {
        return true; // Deletion successful
    } else {
        return false; // Deletion failed
    }
    $statement->closeCursor();
}

// Add products function.
function add_product($code, $name, $version, $release_date) {
    global $db;
    // Check if the product code already exists.
    $existing_product = get_product($code);
    if ($existing_product) {
        // Product code already exists, return false.
        return false;
    }
    $query = 'INSERT INTO products
                 (productCode, name, version, releaseDate)
              VALUES
                 (:code, :name, :version, :release_date)';
    $statement = $db->prepare($query);
    $statement->bindValue(':code', $code);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':version', $version);
    $statement->bindValue(':release_date', $release_date);
    // Product boolean result for adding.
    if ($statement->execute()) {
        return true; // Product added successfully.
    } else {
        return false; // Product adding failed.
    }
    $statement->closeCursor();
}

// Update products function.
function update_product($code, $name, $version, $release_date) {
    global $db;
    $query = 'UPDATE products
              SET name = :name,
                  version = :version,
                  releaseDate = :release_date
              WHERE productCode = :product_code';
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':version', $version);
    $statement->bindValue(':release_date', $release_date);
    $statement->bindValue(':product_code', $code);
    $statement->execute();
    $statement->closeCursor();
}
?>
