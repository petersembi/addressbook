<?php
include "classes/Address.php";
require_once("config/db.php");

$addressesObj = new Address();
$addressesObj->exportToJson();
$addressesObj->exportToXml();
?>


