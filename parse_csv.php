<?php
// Check if the necessary command-line arguments are provided
if(isset($argv[1]) && isset($argv[2])) {
    // Extract filename and dry run flag from command-line arguments
    $filename = $argv[2];
    $dry_run = false; // Default to false

    // Check if --dry_run option is provided
    if(isset($argv[3])){
        if( $argv[3] == "--dry_run") {
            $dry_run = true;
        } else {
            echo "Error: invalid command line argument";
            exit(1);
        }
    }
    
    // Open the CSV file
    $file = fopen($filename, "r");
    if($file){
        // Check if the users table exists
        require_once "db_connect.php";
        $table_check_query = "SHOW TABLES LIKE 'users'";
        $result = mysqli_query($conn, $table_check_query);

        if ($result && mysqli_num_rows($result) > 0) {
        //skip the first header
        fgetcsv($file);
        //read and process each line of CSV file
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {
            $firstName = ucfirst(strtolower(trim($emapData[0])));
            $lastName = ucfirst(strtolower(trim($emapData[1])));
            $email = strtolower(trim($emapData[2]));
            
            echo "Processing email: $email\n";
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if(!$dry_run) {
                    require_once "db_connect.php";
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
                    // Do not close the connection here
                } else {
                    echo "This is a dry run. No records inserted.\n";
                }
            } else {
                echo "Invalid email: $email. Please check the email address and try again.\n";
            }
            } 
        } else {
            fclose($file);
            echo "Please create users table first.\n";
        }

        // Close the connection after finishing database operations
        if(!$dry_run) {
            mysqli_close($conn);
        }

        $status = "CSV has been successfully processed.\n";
        echo $status;
    } else {
        echo "Error: Unable to open CSV file.\n";
    }
} else {
    echo "Error: Invalid or missing command-line arguments.\n";
}
?>
