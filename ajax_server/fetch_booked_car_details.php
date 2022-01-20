<?php
require_once "../config/ClassConnectDB.php";
require_once "../classes/BookedCars.php";

$booked_cars_object_array = BookedCars::getBookedCars();

if (empty($booked_cars_object_array)) {
} else {
    //print_r($booked_cars_object_array);
    echo "<table>";
    echo "<thead>";
    echo "<th> Customer Name </th> <th> Vehicle Model </th> <th> Start Date </th> <th> No of Days </th> <th> Total Rent </th>";
    echo "</thead>";

    foreach ($booked_cars_object_array as $carObj) {
        echo "<tr>";
        echo "<td>" . $carObj->userName[0]->userName . "</td>";
        echo "<td>" . $carObj->vehicleModel[0]->vehicleModel . "</td>";
        echo "<td>" . substr($carObj->startDate, 0, 10) . "</td>";
        echo "<td>" . $carObj->noOfDays . "</td>";
        echo "<td>" . $carObj->vehicleRent[0]->vehicleRent * $carObj->noOfDays  . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}
