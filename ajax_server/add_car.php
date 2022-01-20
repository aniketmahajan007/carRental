<?php
session_start();
require_once "../config/ClassConnectDB.php";

$model =  $_REQUEST["model"];
$capacity = $_REQUEST["capacity"];
$rent = $_REQUEST["rent"];

$DB_CONN = new ConnectDB();

$sql = "insert into vehicle(vehicleModel, seatingCapacity, rent) values('$model','$capacity','$rent')";

if ($DB_CONN->query($sql) == true) {
    echo "Car Added Successfully";
} else
    echo "Failed";
