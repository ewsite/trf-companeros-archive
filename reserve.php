<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

$room_package_1_res = mysqli_query($con, "SELECT * from rooms WHERE package_no = 1");
$room_package_2_res = mysqli_query($con, "SELECT * from rooms WHERE package_no = 2");
$room_package_3_res = mysqli_query($con, "SELECT * from rooms WHERE package_no = 3");

$room_package_1 = mysqli_fetch_all($room_package_1_res, MYSQLI_ASSOC);
$room_package_2 = mysqli_fetch_all($room_package_2_res, MYSQLI_ASSOC);
$room_package_3 = mysqli_fetch_all($room_package_3_res, MYSQLI_ASSOC);

$rooms = [];

array_push($rooms, [ "package_no" => 1, "limit" => 15, "rooms" => $room_package_1 ]);
array_push($rooms, [ "package_no" => 2, "limit" => 15, "rooms" => $room_package_2 ]);
array_push($rooms, [ "package_no" => 3, "limit" => 15, "rooms" => $room_package_3 ]);


$room_items = 3;
$loggedIn = isset($_SESSION["customer_no"]);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="res/logo.png">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="icon" href="favicon.png">
    <!--font-awesome-->
    <link rel="stylesheet" href="/plugins/fontawesome/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">
    <title>Reservation | TRF Hotel- Campaňeros Hotel </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>
   

    <script src="/plugins/jquery/jquery-3.7.1.min.js"></script>
    <link href="/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <script src="/assets/js/guestReservation.js" defer></script>
    <script src="/plugins/sweetalert2/sweetalert2.all.min.js" defer></script>
    <link rel="stylesheet" href="/assets/css/navbar.css">
    <script src="/assets/js/navbar.js" defer></script>
</head>

<body class="darkbg">
    <script>
        var rooms = <?= json_encode($rooms) ?>;
        var selectedPackage = <?= intval($_GET['package'] ?? 0) ?>;
    </script>
<!-- Navbar --------------------------------------------------------------------------------->
    <header>
        <nav id="custom-navbar">
            <a href="/" id="custom-navbar-logo">
                <img src="/favicon.png" alt="">
            </a>
            <div id="custom-navbar-nav">
                <div id="custom-navbar-lists" class="d-none d-md-block">
                    <a href="/">Home</a>
                    <a href="/#main-desc">Facilities</a>
                    <a href="/#about">About Us</a>
                    <a href="/#FAQ">FAQ</a>
                    <a href="/#inquiry">Inquire</a>
                    <a href="/#package" class="btn btn-success">Book Now!</a>
                </div>
                <div id="custom-navbar-actions">
                    <?php if ($loggedIn): ?>
                        <a class="btn btn-primary" href="/client/dashboard.php">Dashboard</a>
                    <?php else: ?>
                        <a class="btn btn-primary" href="/login.php">Log In</a>
                    <?php endif ?>
                    <button class="btn d-block d-md-none" id="dropdown-toggle">
                        <i class="fas fa-bars text-light"></i>
                    </button>
                </div>
            </div>
        </nav>
        <aside id="custom-dropdown">
            <div id="custom-dropdown-container">
                <div id="custom-dropdown-lists">
                    <a href="/">Home</a>
                    <a href="/#main-desc">Facilities</a>
                    <a href="/#about">About Us</a>
                    <a href="/#FAQ">FAQ</a>
                    <a href="/#inquiry">Inquire</a>
                    <a href="/#package" class="btn btn-success">Book Now!</a>
            </div>
            </div>
        </aside>
    </header>
<div class="container">
    <div class="row w-100 gap-4">
        <div class="col">
            <div class="card w-100">
                <div class="card-header">
                    <h3 class="m-0" >Summary</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column">
                    <div id="inquiry-status" class="rounded bg-primary text-light p-4"></div>
                    <div class="mt-2">
                        <b>Price</b>
                        <h2 id="price-indicator">Php 0.00</h2>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <form class="w-100 bg-light p-4 rounded" method="POST">
                <div class="mb-3">
                    <h2>Inquiry</h2>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="expected-date">Expected Date:</label>
                    <input class="form-control" type="date" id="cbodate" name="expecteddate" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="packageno">Selected Package:</label>
                    <select class="form-control" id="cbopackage" name="packageno" required>
                        <option value="0" disabled>--SELECT--</option>
                        <option value="1">Package 1</option>
                        <option value="2">Package 2</option>
                        <option value="3">Package 3</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="packageno">Selected Room:</label>
                    <select class="form-control" id="cboroom" name="room_no" required>   
                    </select>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">  
                        <label class="form-label" for="name">First Name:</label>
                        <input class="form-control" type="text" id="fname" name="fname" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="name">Last Name:</label>
                        <input class="form-control" type="text" id="lname" name="lname" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Email:</label>
                    <input class="form-control" type="email" id="email" name="email" required>
                </div>
                <div class="mb-3">   
                    <label class="form-label" for="contact">Contact:</label>
                    <input class="form-control" type="text" id="contact" name="contact" maxlength="11" required>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label" for="cboduration">Stay Duration:</label>
                        <select class="form-control" id="cboduration" name="stayduration" required>
                            <option value="0" disabled selected>--SELECT--</option>
                            <option value="3">3 Hours</option>
                            <option value="6">6 Hours</option>
                            <option value="9">9 Hours</option>
                            <option value="12">12 Hours</option>
                            <option value="24">24 Hours</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="cboperson">Person: </label>
                        <input class="form-control" type="number" name="person" id="cboperson" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="message">Message (Optional)</label>
                    <textarea class="form-control" name="message" cols="30" rows="2"></textarea>
                </div>
                <div class="mb-3">
                    <input type="submit" id="reserve-submit" class="btn btn-success" value="Submit">
                </div>
            </form>
        </div>

    </div>
</div>

</body>