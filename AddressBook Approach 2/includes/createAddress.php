
<?php
// include the configs for db
require_once("../config/db.php");

// load the registration class
require_once("../classes/registrationAddress.php");

$registration = new AddressRegistration();

// show the register form
header("location:../index.php?error=none");

