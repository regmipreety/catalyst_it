<?php
include_once "db_connect.php";
$lines = file('users.csv', FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
$csv = array_map('str_getcsv', $lines);

$col_names = array_shift($csv);


$users = [];
$stmt = 'INSERT INTO users (name, surname, email) VALUES (?,?,?)';
mysqli_query($conn, $stmt) or die(mysqli); 
foreach($csv as $row) {
    $users[] = [
        $col_names[0] => ucfirst(strtolower($row[0])),
        $col_names[1] => ucfirst(strtolower($row[1])),
        $col_names[2] => strtolower(strtolower($row[2])),
    ];
}

foreach($users as $user) {
    $stmt->execute($user);
}

?>