<?php
require_once '../config/ClassConnectDB.php';
require_once 'UserDetails.php';
require_once 'VehicleDetails.php';

class BookedCars
{
    var $startDate;
    var $noOfDays;
    var $userName;
    var $vehicleModel;
    var $vehicleRent;

    public static function getBookedCars()
    {
        $DB_CONN = new ConnectDB();
        $sql = "SELECT * FROM booking";
        $result = $DB_CONN->query($sql);

        $booked_car_object_array = array();
        while ($obj = $result->fetch_object()) {
            $booked_car_object_array[] = new BookedCars($obj);
        }
        return $booked_car_object_array;
    }

    private function __construct($obj)
    {
        $this->startDate = $obj->startDate;
        $this->noOfDays = $obj->daysNumber;
        $this->userName = UserDetails::getUserName($obj->id);
        $this->vehicleModel = VehicleModel::getVehicleModel($obj->vehicleNumber);
        $this->vehicleRent = VehicleRent::getVehicleRent($obj->vehicleNumber);
    }
}
