<?php
if (isset($_POST['save_address']))

//obtain the data from the user
$name =  $_POST['name'];
$first_name = $_POST['first_name'];
$email =  $_POST['email'];
$street =  $_POST['street'];
$zipcode =$_POST['zipcode'];
$city =  $_POST['city'];

//instantiate createAddress controller class
include "../classes/dbh.php";
include "../classes/DatabaseQueries.php";
include "../classes/addressController.php";

$createAddress = new AddressController($name,$first_name, $email,$street,$zipcode,$city);

//error handlers
$createAddress->createAddress();
//going back to the home page
header("location:../index.php?error=none");
?>