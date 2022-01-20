<?php

/*************************************************
 *  PHP file for generating index Page    *
 *************************************************/
require_once "./pages/header.php";
require_once "./classes/VehicleDetails.php";

$vehicle_details_array = VehicleDetails::getVehicleDetails();
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">


<html>

<head>
    <script src="./js/my_javascript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/166fefca87.js" crossorigin="anonymous"></script>


    <script>
        // Go to login
        $(document).on('click', '#bookDefault', function() {
            location.href = "/pages/customer_login.php"
        });

        // Book Car
        $(document).on('click', '.bookCar', function() {
            let temp = $(this).parent().parent();
            var vNo = temp.find('#vehicleNumber').val();
            var sDate = temp.find('#start').val();
            var days = temp.find('#selectDays').find(":selected").text();

            if (sDate === "" || days === "")
                alert("Enter Required Details");

            else {
                $.ajax({
                    url: "./ajax_server/book_car.php",
                    data: {
                        vehicleNumber: vNo,
                        start: sDate,
                        days: days
                    },
                    type: 'post',
                    success: function(response) {
                        alert(response);
                        if (response.trim() == "Booking Successful") {
                            $(this).parent().parent().parent().reset();
                        }
                    },
                });
                temp[0].reset();
            }
        });

        // Add Car
        $(document).on('click', '#addCarBtn', function() {
            var model = $('#model').val();
            var capacity = $('#capacity').val();
            var rent = $('#rent').val();

            if (Empty_check('addCar'))
                alert("Enter Required Details");
            else {

                $.ajax({
                    url: "./ajax_server/add_car.php",
                    data: $("#addCar").serialize(),
                    type: 'post',
                    success: function(response) {
                        alert(response);
                        if (response.trim() == "Car Added Successfully") {
                            document.getElementById("addCar").reset();
                            document.location.href = "/";
                        }
                    },
                });
            }
        });

        // View Booked Car
        $(document).on('click', '#viewBookedCarBtn1', function() {
            $.ajax({
                url: "./ajax_server/fetch_booked_car_details.php",
                type: 'get',
                success: function(response) {
                    $("#bookedCarModalBody").html(response);
                },
            })
        });

        // Pass Data to Edit Car Model
        $(document).on('click', '.editCar', function() {
            let temp = $(this).parent().parent();
            var vNo = temp.find('#vehicleNumber').val();
            var vModel = temp.parent().find('#vehicleModel').html();
            var vCapacity = temp.parent().find('#vehicleCapacity').html();
            var vRent = temp.parent().find('#vehicleRent').html();

            $(".modal-body #updateNumber").val(vNo);
            $(".modal-body #updateModel").val(vModel);
            $(".modal-body #updateCapacity").val(vCapacity);
            $(".modal-body #updateRent").val(vRent);
        });

        // Update Car Details

        $(document).on('click', '#updateCarDetails', function() {
            var model = $('#updateModel').val();
            var capacity = $('#updateCapacity').val();
            var rent = $('#updateRent').val();

            if (Empty_check('updateCar'))
                alert("Enter Required Details");
            else {

                $.ajax({
                    url: "./ajax_server/update_car_details.php",
                    data: $("#updateCar").serialize(),
                    type: 'post',
                    success: function(response) {
                        alert(response);
                        if (response.trim() == "Car Details Updated Successfully") {
                            document.getElementById("updateCar").reset();
                            document.location.href = "/";
                        }
                    },
                });
            }
        });
    </script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col mt-5" style="text-align: center">
                <h2> Available Cars to Rent </h2>
            </div>
        </div>

        <div class="row mt-3 align-items-center justify-content-center">
            <?php if (isset($_SESSION['agent']) && $_SESSION['agent'] == 1) { ?>
                <div class="row">
                    <div class="col text-center">
                        <button type="button" class="btn-light text-primary" data-bs-toggle="modal" data-bs-target="#addCarModal">
                            Add New Car
                        </button>
                    </div>
                    <div class="col text-center">
                        <button type="button" id="viewBookedCarBtn1" class="btn-light text-primary" data-bs-toggle="modal" data-bs-target="#viewBookedCarModal">
                            View Booked Car
                        </button>
                    </div>
                </div>
            <?php } ?>
            <?php
            foreach ($vehicle_details_array as $vehicle) {
            ?>
                <div class="col-12 col-md-3 m-3 card" style="background-color: aliceblue;">
                    <div class="card-body">

                        <h5 class="card-title text-center" id="vehicleModel"><?php echo $vehicle->vehicle_model ?></h5>

                        <div class="mx-2">
                            <hr />
                        </div>
                        <label>Vehicle Number - </label>
                        <span class="card-text"><?php echo $vehicle->vehicle_number ?></span> <br />
                        <label>Vehicle Capacity - </label>
                        <span class="card-text" id="vehicleCapacity"><?php echo  $vehicle->vehicle_capacity ?></span> <br />
                        <label>Vehicle Rent - </label>
                        <span class="card-text" id="vehicleRent"><?php echo $vehicle->vehicle_rent ?></span> <br />

                        <form id="book_car" name="book_car">
                            <input type="hidden" id="vehicleNumber" class="vehicleNumber" value=<?php echo $vehicle->vehicle_number ?>>
                            <p class="mt-3"> No of days:-
                                <select class="form-select" id="selectDays" class="selectDays" aria-label="Default select example">
                                    <option selected>Select No. of days</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </p>
                            <label for="start">Start Date:</label>
                            <input type="date" id="start" class="start" name="start" />
                            <div class="text-center">
                                <?php if (!isset($_SESSION['user'])) { ?>
                                    <button type="button" id="bookDefault" class="btn btn-primary mt-4 card-link">Book</button>
                                <?php } else if (isset($_SESSION['agent']) && $_SESSION['agent'] != 1) { ?>
                                    <button type="button" id="bookCar" class="btn btn-primary mt-4 card-link bookCar">Book</button>
                                <?php } else { ?>
                                    <button type="button" disabled class="btn btn-info mt-4 card-link">Book</button>
                                <?php }
                                if (isset($_SESSION['agent']) && $_SESSION['agent'] == 1) { ?>
                                    <button type="button" id="editCar" class="btn btn-primary mt-4 card-link editCar" data-bs-toggle="modal" data-bs-target="#updateCarModal">Edit</button>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>


        <!-- Add Car Modal -->
        <div class="modal fade" id="addCarModal" tabindex="-1" aria-labelledby="addCarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCarModalLabel">Add New Car</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-5">
                        <form id="addCar">
                            <div class="row">
                                <label for="model">Vehicle Model: </label>
                                <input type="text" id="model" name="model" />
                            </div>
                            <div class="row">
                                <label for="capacity">Vehicle Capacity:</label>
                                <input type="text" id="capacity" name="capacity" />
                            </div>
                            <div class="row">
                                <label for="rent">Vehicle Rent(per day):</label>
                                <input type="text" id="rent" name="rent" />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="addCarBtn" data-bs-dismiss="modal" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Booked Car Modal -->
        <div class="modal fade" id="viewBookedCarModal" tabindex="-1" aria-labelledby="viewBookedCarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="viewBookedCarModalLabel">View Booked Cars</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-5">
                        <p id="bookedCarModalBody">

                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Update Car Modal -->
        <div class="modal fade" id="updateCarModal" tabindex="-1" aria-labelledby="updateCarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateCarModalLabel">View Booked Cars</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-5">
                        <form id="updateCar">
                            <input type="hidden" id="updateNumber" name="updateNumber" />
                            <div class="row">
                                <label for="updateModel">Vehicle Model: </label>
                                <input type="text" id="updateModel" name="updateModel" />
                            </div>
                            <div class="row">
                                <label for="updateCapacity">Vehicle Capacity:</label>
                                <input type="text" id="updateCapacity" name="updateCapacity" />
                            </div>
                            <div class="row">
                                <label for="updateRent">Vehicle Rent(per day):</label>
                                <input type="text" id="updateRent" name="updateRent" />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="updateCarDetails" data-bs-dismiss="modal">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>