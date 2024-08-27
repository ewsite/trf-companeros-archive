<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $dates = $_POST['dates'];
    $oras = $_POST['oras'];
    $packageno = $_POST['packageno'];
    $presyo = $_SESSION['presyo'];
    $inclusion = $_SESSION['inclusion'];

    $sql = "insert into main_table (lname, fname, cpnumber, email, date_created, room_no, package, package_time, expected_date, customer_price, customer_inclusion, status) values ('$lastname', '$firstname', '$contact', '$email', NOW(), '$packageno', '$oras', '$dates', '$presyo', '$inclusion', '1')";
    // $sql = "insert into main_table (lname, fname, email, cpnumber, date_created, expected_date, status) values ('$lastname', '$firstname', '$contact', '$email1', NOW(), '$dates', '1')";
    if (!empty($lastname) && !empty($firstname) && !empty($contact) && !empty($email1) && !empty($dates) && !empty($oras)) {

        if (mysqli_query($con, $sql)) {

            echo 'Reserve Successfully';
        } else {
            echo 'ERROR:ERROR';
        }
    } else {
        echo 'EMPTY FIELDS';
    }
}
