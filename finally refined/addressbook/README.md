-In Phpmyadmin, import the db_setup.sql in \_installation_db_files folder to create the database and tables.
-Import the test_data.sql in \_installation_db_files folder to populate test data.
-Access the project on localhost.

Please Note:

-Bootstrap CDN used, please connect computer to the internet.
-Exported json and xml files are stored in the storage folder.


//CODE SET UP
- under classes folder, we have the Dbh class which creates a database connection. It is located in the dbh.php file. 
- The DatabaseQueries class has functions which involve querying the database,. 
- This class is extended to AddressController class. AddressController class initializes the form input variables, does error checks, upon success connects to  DatabaseQueries class for querying the database. 
-includes folder contains edit.php and createAddress.php, which check whether the respective buttons have been clicked, then initializes the form variables in addressController class. 
