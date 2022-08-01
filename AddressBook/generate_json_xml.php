<?php
include "classes/dbh.php";
include "classes/DatabaseQueries.php";

$addressesObj = new DatabaseQueries();
$addressesObj->exportToJson();
$addressesObj->exportToXml();
?>


