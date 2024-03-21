<?php
$status = "Error importing csv files \n";
if(isset($argv[1]) && $argv[1] == "--file") {
    // Check if the --file argument is provided
    $filename = $argv[2];
    echo "CSV file name: $filename\n";
    // Call the function to parse the CSV file
    parseCSV($filename);
} else {
    // Display error if CSV file is not specified or argument is invalid
    echo "Error: CSV file not specified or invalid argument.\n";
}
// Function to parse CSV file
   function parseCSV($filename){
    include_once "db_connect.php";

        $file = fopen($filename, "r");
        if($file){
            //skip the first header
            fgetcsv($file);
            //read and process each line of CSV file
            while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE) {
                $firstName = ucfirst(strtolower(trim($emapData[0])));
                $lastName = ucfirst(strtolower(trim($emapData[1])));
                $email = strtolower(trim($emapData[2]));
                
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
            
        }
       
    fclose($file);
    $status = "CSV has been successfully updated \n";

    echo $status;
   }
    

?>