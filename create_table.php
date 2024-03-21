<?php
include_once "db_connect.php";
   
$table = "users";

$createTableQuery = "
    CREATE TABLE IF NOT EXISTS $table (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        surname VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL
    )
";

if (mysqli_query($conn, $createTableQuery)) {
    echo "Table '$table' created successfully (or already exists).";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
    
?>

