<?php
require_once "../config/ClassConnectDB.php";
require_once "../classes/Registration.php";

$name =  $_REQUEST["name"];
$email = $_REQUEST["email"];
$pass = $_REQUEST["password"];

$userCount_object_array = Registration::getUserCount();
$count = $userCount_object_array[0]->count;

$DB_CONN = new ConnectDB();

if ($count == 0) {
    $sql = "insert into login(name,email,password,agency) values('$name','$email','$pass',0)";
    if ($DB_CONN->query($sql) == true) {
        echo "Registration Successful";
    } else
        echo "Failed";
} else {
    $emailCheck_object_array = Email::checkEmail($email);
    if (isset($emailCheck_object_array[0])) {
        $email_id = $emailCheck_object_array[0]->email;
        if (empty($email_id)) {
            $sql = "insert into login(name,email,password,agency) values('$name','$email','$pass',0)";
            if ($DB_CONN->query($sql) == true)
                echo "Registration Successful";
        } else
            echo "Email Already Exists";
    } else {
        $sql = "insert into login(name,email,password,agency) values('$name','$email','$pass',0)";

        if ($DB_CONN->query($sql) == true)
            echo "Registration Successful";
        else
            echo "Failed";
    }
}
