<?php
session_start();
require_once "../config/ClassConnectDB.php";

$vehicleNumber =  $_REQUEST["updateNumber"];
$model =  $_REQUEST["updateModel"];
$capacity = $_REQUEST["updateCapacity"];
$rent = $_REQUEST["updateRent"];

$DB_CONN = new ConnectDB();

$sql = "update vehicle set vehicleModel = '$model', seatingCapacity = '$capacity', rent = '$rent' where vehicleNumber = '$vehicleNumber'";

if ($DB_CONN->query($sql) == true) {
    echo "Car Details Updated Successfully";
} else
    echo "Failed";
