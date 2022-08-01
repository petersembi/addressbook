<?php
$server_name = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "addressbook";

$con = mysqli_connect($server_name,$db_username,$db_password,$db_name);

if(!$con){
    die('Connection Failed, Please check that your database details are setup correctly.');
}

?>