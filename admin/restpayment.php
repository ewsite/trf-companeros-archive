<?php 
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";;
require_once $_SERVER["DOCUMENT_ROOT"]."/lib/mailer/Mailer.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/lib/mailer/MailerTemplate.php";
    
if (isset($_POST['restpay']) && isset($_POST['customerid']) 
    && isset($_POST['mainid'])
) {
    $resofpayment = $_POST['restpay'];
    $customerid = $_POST['customerid'];
    $mainid = $_POST['mainid'];

    
    // Get customer information
    $customer_info_result = mysqli_query($con, "SELECT fname, lname, email, contact from user_accounts WHERE customer_no='$customerid'");
    
    if (mysqli_num_rows($customer_info_result) == 0) {
        die("Account Number $customerid not found!");
    }
    
    $customer_info = mysqli_fetch_assoc($customer_info_result);

    // Get current customer transaction information
    $transaction_info_result = mysqli_query($con, "SELECT main_id, package, room_no, expected_date from main_table where customer_id='$customerid'");
    if (mysqli_num_rows($customer_info_result) == 0) {
        die("Transaction of Account Number $customerid not found!");
    }
    $transaction_info = mysqli_fetch_assoc($transaction_info_result);
    $package = $transaction_info["package"];
    $main_id = $transaction_info["main_id"];
    $room_no = $transaction_info["room_no"];

    // Get package information
    $room_info_result = mysqli_query($con, "SELECT * from rooms WHERE room_no='$room_no'");
    $room_info = mysqli_fetch_assoc($room_info_result);


    $mailer = new Mailer($customer_info["email"], "Payment Completed");
    $mailer->message(MailerTemplate::restPaid($customer_info["fname"], $customer_info["lname"], $room_info["room_no"], 0, $transaction_info["expected_date"]));
    
    $sqlrestpay = mysqli_query($con, "UPDATE main_table SET amountfor_fullpay='$resofpayment', status='7' WHERE main_id ='$mainid' AND customer_id='$customerid'");
    $mailer->send();
    $put_result = mysqli_query($con, "UPDATE main_table SET occupied = 1, reserved = 0 WHERE main_id='$main_id'");
    if ($put_result) {
        echo "Success";
    }
    else {
        echo "Failed";
    }
}else{
    echo "Missing Variable";
}

?>