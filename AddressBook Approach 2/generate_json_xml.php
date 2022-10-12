<?php
include "classes/dbh.php";
include "classes/DatabaseQueries.php";
include "classes/registrationAddress.php";
require_once("config/db.php");

$addressesObj = new AddressRegistration();
$addressesObj->exportToJson();
$addressesObj->exportToXml();
?>


