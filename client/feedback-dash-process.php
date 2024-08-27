<?php
include ('connection.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $feedback = $_POST['feedback'];
    $customer_no = $_POST['customer_no'];
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    date_default_timezone_set("Asia/Manila");
    $datenow = date("y-m-d h:i:sa");
    // $customer_no = strtotime('2023-05-18 10:30:00');
    // $integerTimestamp = (int) $customer_no;
    $sql = "insert into client_feed (client_id, message, lname, fname, email, contact, date_send) 
    values ($customer_no, '$feedback', '$lname', '$fname', '$email', '$contact', '$datenow')";

    if (mysqli_query($con, $sql)) {

        echo 'Success';
    } else {
        echo 'Failed to send your feedback';
    }
}

?>