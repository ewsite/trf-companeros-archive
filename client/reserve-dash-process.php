<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $date = $_POST['date'];
    $time = $_POST['time'];
    $packages = $_POST['packages'];
    $customer_no = $_POST['customer_no'];
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $presyo = $_SESSION['price'];
    $inclusion = $_SESSION['inclusion'];

    // $integerTimestamp = (int) $customer_no;
    $sql = "insert into main_table (customer_id, date_created, package, customer_inclusion, customer_price, package_time, expected_date,  lname, fname, email, cpnumber, status) 
    values ($customer_no, NOW(), '$packages', '$inclusion', '$presyo','$time', '$date', '$lname', '$fname', '$email', '$contact', '2')";

    if (mysqli_query($con, $sql)) {

        echo 'Submitted';
    } else {
        echo 'ERROR: ERROR';
    }
}
?>
