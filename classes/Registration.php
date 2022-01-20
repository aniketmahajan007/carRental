<?php

/***************************************************************************
 *                   	PHP page for Registration	 	                   *
 ****************************************************************************/

require_once '../config/ClassConnectDB.php';

class Registration
{
    var $count;

    public static function getUserCount()
    {
        $DB_CONN = new ConnectDB();
        $sql = "SELECT COUNT(*) as count FROM login";
        $result = $DB_CONN->query($sql);

        $userCount_object_array = array();
        while ($obj = $result->fetch_object()) {
            $userCount_object_array[] = new Registration($obj);
        }
        return $userCount_object_array;
    }
    private function __construct($obj)
    {
        $this->count = $obj->count;
    }
}

class Email
{
    var $email;

    public static function checkEmail($email)
    {
        $DB_CONN = new ConnectDB();
        $sql = "select email from login where email ='$email'";

        $result = $DB_CONN->query($sql);

        $emailCheck_object_array = array();
        while ($obj = $result->fetch_object()) {
            $emailCheck_object_array[] = new Email($obj);
        }
        return $emailCheck_object_array;
    }

    private function __construct($obj)
    {
        $this->email = $obj->email;
    }
}
