<?php
$status = "Error importing csv files \n";
$filename = $argv[1];

//get the filename
include_once "db_connect.php";

    $file = fopen($filename, "r");
    while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {
        $firstName = ucfirst(strtolower($emapData[0]));
        $lastName = ucfirst(strtolower($emapData[1]));
        $email = strtolower($emapData[2]);
        
        echo "Processing email: $email\n";
    
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Prepare the SQL statement
            $sql = "INSERT INTO users(name, surname, email) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            
            // Bind parameters
            mysqli_stmt_bind_param($stmt, "sss", $firstName, $lastName, $email);
            
            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {
                echo "Record inserted successfully.\n";
            } else {
                echo "Error inserting record: " . mysqli_error($conn) . "\n";
            }
    
            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Invalid email: $email. Please check the email address and try again.\n";
        }
    }
    
fclose($file);
$status = "CSV has been successfully updated \n";

echo $status;

?>