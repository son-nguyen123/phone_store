<?php

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phone_store";

// Create mysqli connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check mysqli connection
if ($conn->connect_error) {
    die("Connection failed (MySQLi): " . $conn->connect_error);
}

// Optional: Create a PDO connection
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    exit("Connection failed (PDO): " . $e->getMessage());
}

// Query to fetch products from the 'products' table
$sql = "SELECT product_id, name, description, price, image, created_at FROM products";
$result = $conn->query($sql);

// Array to store the fetched products
$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row; // Add each product row to the products array
    }
}

// Close the mysqli connection
$conn->close();

// Note: PDO connection can also be used for future queries if desired
?>