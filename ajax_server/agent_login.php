<?php

/***************************************************************************
 *                 	   PHP page for login		                   			*
 ****************************************************************************/

session_start();

require_once "../config/ClassConnectDB.php";

$DB_CONN = new ConnectDB();

$email = $_REQUEST["email"];
$pass = $_REQUEST["password"];

$sql = "SELECT * from login where email='$email' and password='$pass' and agency=1";
$result = $DB_CONN->query($sql);

//print_r($sql);

if ($obj = $result->fetch_object()) {
    $_SESSION['user'] = $obj->email;
    $_SESSION['name'] = $obj->name;
    $_SESSION['agent'] = $obj->agency;
    echo $_SESSION['user'];
    //echo $obj->email;
} else
    echo 0;
