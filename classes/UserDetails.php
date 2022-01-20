<?php
require_once '../config/ClassConnectDB.php';

class UserDetails
{
    var $userName;
    public static function getUserName($user_id)
    {
        $DB_CONN = new ConnectDB();
        $sql = "SELECT name FROM login where id = $user_id";
        $result = $DB_CONN->query($sql);

        $user_name = array();
        while ($obj = $result->fetch_object()) {
            $user_name[] = new UserDetails($obj);
        }
        return $user_name;
    }

    private function __construct($obj)
    {
        $this->userName = $obj->name;
    }
}
