<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Adjust if your MySQL has a different username
$password = ""; // Set your MySQL password if it exists
$dbname = "phone_store";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
