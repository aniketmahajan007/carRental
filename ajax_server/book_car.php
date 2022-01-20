<?php
session_start();
require_once "../config/ClassConnectDB.php";

$vehicleNumber =  $_REQUEST["vehicleNumber"];
$start = $_REQUEST["start"];
$days = $_REQUEST["days"];
$id = $_SESSION["id"];

$DB_CONN = new ConnectDB();

$sql = "insert into booking(startDate, daysNumber, id, VehicleNumber) values('$start','$days','$id','$vehicleNumber')";

if ($DB_CONN->query($sql) == true) {
    echo "Booking Successful";
} else
    echo "Failed";
