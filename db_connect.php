<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "catalyst";

// Create a connection (object-oriented)
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";
?>
