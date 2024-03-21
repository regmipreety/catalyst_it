<?php
$status = "Error importing csv files \n";
$userInput = $argv[1];
switch ($userInput){
    case '--file':
    // Call the function to parse the CSV file
        include "parse_csv.php";
        break;
    case '--create_table':
        echo "creating table...";
        include "create_table.php";
        break;
    case '-u':
        echo "root";
        break;
    case '-p':
        echo "";
        break;
    case '-h';
        echo "localhost";
        break;
    case '--help':
        include "display_list.php";
        break;
        
    default:
        echo "invalid argument provided";

}

    
?>