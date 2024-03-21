# Catalyst IT 
## Requirements
    * Php version 8.0.*
    * Xammp server or any other server to run localhost and MySql server

## Running the application
    * Download/clone from the git repository: https://github.com/regmipreety/catalyst_it
    * open terminal 
    * run php -v to check if php is installed correctly
    * run mysql -u root and enter your mysql password to check if mysql server is running
    * now, you can run php user_upload and all available command-line directives 

## Tesing the application
    In terminal, run following commands
    * php user_upload.php --file users.csv - this will open the csv file and check if the data connections are working
    * php user_upload.php --create_table- this will create users table in the database
    once the table is created, we can now run php user_upload.php --file users.csv command which is read the csv file and also insert rows into the table
    * php user_upload.php --file users.csv --dry_run, it will run through the rows in the csv file, but won't save in the DB
    - php user_upload.php --help will give the list of available options

    
