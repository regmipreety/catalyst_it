<?php
$status = "Error importing csv files";
$filename = $argv[1];

//get the filename
include_once "db_connect.php";

    $file = fopen($filename, "r");
    while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
    {
        $sql= "INSERT into users(name, surname, email) values ('$emapData[0]','$emapData[1]','$emapData[2]')";
        mysqli_query($conn, $sql);
    }
fclose($file);
$status = "CSV has been successfully updated";

echo $status;

?>