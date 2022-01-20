<?php

$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root . '/config/ClassConnectDB.php';

class VehicleDetails
{
    var $vehicle_model;
    var $vehicle_number;
    var $vehicle_capacity;
    var $vehicle_rent;

    public static function getVehicleDetails()
    {
        $DB_CONN = new ConnectDB();
        $sql = "SELECT * FROM vehicle";
        $result = $DB_CONN->query($sql);

        $vehicle_details = array();
        while ($obj = $result->fetch_object()) {
            $vehicle_details[] = new VehicleDetails($obj);
        }
        //print_r($vehicle_details);
        return $vehicle_details;
    }

    private function __construct($obj)
    {
        $this->vehicle_model = $obj->vehicleModel;
        $this->vehicle_number = $obj->vehicleNumber;
        $this->vehicle_capacity = $obj->seatingCapacity;
        $this->vehicle_rent = $obj->rent;
    }
}

class VehicleModel
{
    var $vehicleModel;

    public static function getVehicleModel($vehicleNumber)
    {
        $DB_CONN = new ConnectDB();
        $sql = "SELECT vehicleModel FROM vehicle where vehicleNumber = $vehicleNumber";
        $result = $DB_CONN->query($sql);

        $vehicle_model = array();
        while ($obj = $result->fetch_object()) {
            $vehicle_model[] = new VehicleModel($obj);
        }
        //print_r($vehicle_details);
        return $vehicle_model;
    }

    private function __construct($obj)
    {
        $this->vehicleModel = $obj->vehicleModel;
    }
}

class VehicleRent
{
    var $vehicleRent;

    public static function getvehicleRent($vehicleNumber)
    {
        $DB_CONN = new ConnectDB();
        $sql = "SELECT rent FROM vehicle where vehicleNumber = $vehicleNumber";
        $result = $DB_CONN->query($sql);

        $vehicle_rent = array();
        while ($obj = $result->fetch_object()) {
            $vehicle_rent[] = new VehicleRent($obj);
        }
        //print_r($vehicle_details);
        return $vehicle_rent;
    }

    private function __construct($obj)
    {
        $this->vehicleRent = $obj->rent;
    }
}
