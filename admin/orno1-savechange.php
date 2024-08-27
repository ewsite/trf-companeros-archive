<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/lib/mailer/Mailer.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/lib/mailer/MailerTemplate.php";

if (isset($_POST['price']) && isset($_POST['or_no1']) && isset($_POST['cus_amount']) 
&& isset($_POST['inquiryid']) && isset($_POST['half']) && isset($_POST['total'])
&& isset($_POST['customerid'])) {
    $orno1 = $_POST['or_no1'];
    $cus_amount = $_POST['cus_amount'];
    $inquiryid = $_POST['inquiryid'];
    $customerid = $_POST['customerid'];
    $price = $_POST['price'];
    $half = $_POST['half'];
    $total = $_POST['total'];

    $balance = (int)$price - (int)$cus_amount;
    $trasactionno = 0;
    if ((int)$balance == 0) {
        $status = '7';
    }else{
        $status = '6';
    }
    
    $userid = $_SESSION['id'];
    date_default_timezone_set("Asia/Manila");
    // $datenow = date_default_timezone_get();
    // $customerno = $_SESSION['customer_no'];
    $transaction_no = $orno1;
    //get price
    $sqlget = mysqli_query($con, "SELECT * FROM main_table WHERE customer_id='$customerid' AND main_id='$inquiryid'");
    $result = mysqli_fetch_assoc($sqlget);
    $main_id = $result['main_id'];
    $price = $result['customer_price'];
    $package = $result['package'];
    $room_no = $result['room_no'];
    $expectdate = $result['expected_date'];
    $datecreate = $result['date_created'];
    $datenow = date("y-m-d h:i:sa");

    // Get customer information
    $customer_info_result = mysqli_query($con, "SELECT fname, lname, email, contact from user_accounts WHERE customer_no='$customerid'");
    
    if (mysqli_num_rows($customer_info_result) == 0) {
        die("Account Number $customerid not found!");
    }
    
    $customer_info = mysqli_fetch_assoc($customer_info_result);

    // Get package information
    $room_info_result = mysqli_query($con, "SELECT * from rooms WHERE room_no='$room_no'");
    $room_info = mysqli_fetch_assoc($room_info_result);


    // Payment completed, plz occupy
    if ($status =='7') {
        $mailer = new Mailer($customer_info["email"], "Payment Completed");
        $mailer->message(MailerTemplate::fullyPaid($customer_info["fname"], $customer_info["lname"], $room_info["room_no"], 0, $orno1, $expectdate));
        $sqlchoose = mysqli_query($con,"UPDATE main_table set customer_price='$total', userid='$userid', date_update='$datenow', or_no1 ='$orno1', amountfor_fullpay='$cus_amount', status='$status', transaction_no='$transaction_no' where main_id='$inquiryid'");
        $mailer->send();
        $put_result = mysqli_query($con, "UPDATE main_table SET occupied = 1, reserved = 0 WHERE main_id='$main_id'");
        if ($put_result) {
            echo "Success";
        }
        else {
            echo "Failed";
        }
    }elseif ($status == '6') {
        $mailer = new Mailer($customer_info["email"], "Payment Received");
        $mailer->message(MailerTemplate::notFullyPaid($customer_info["fname"], $customer_info["lname"], $room_info["room_no"],0, $orno1, $expectdate, $cus_amount, $balance));
        $sqlchoose = mysqli_query($con,"UPDATE main_table set customer_price='$total', userid='$userid', date_update='$datenow', or_no1 ='$orno1', amountfor_dppay='$cus_amount', status='$status', transaction_no='$transaction_no' where main_id='$inquiryid'");
        $mailer->send();
        $put_result = mysqli_query($con, "UPDATE main_table SET occupied = 0, reserved = 1 WHERE main_id='$main_id' ");
        if ($put_result) {
            echo "Success";
        }
        else {
            echo "Failed";
        }
    }

    

}else{
    echo "hindi na post";
}
