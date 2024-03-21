<?php
// Define items for the list
$items = array(
    "--file [csv file name] – this is the name of the CSV to be parsed",
    "--create_table – this will cause the MySQL users table to be built",
    "--dry_run – this will be used with the --file directive in case we want to run the script but not insert into the DB",
    "--help – which will output the above list of directives with details."
);

// Display the list
echo "Directives:\n";
foreach ($items as $item) {
    echo "- $item\n";
}
?>