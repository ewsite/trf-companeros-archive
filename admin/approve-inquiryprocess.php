<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/lib/mailer/Mailer.php";
    require_once $_SERVER["DOCUMENT_ROOT"]."/lib/mailer/MailerTemplate.php";
    
    if (isset($_POST['aprove_inquiryid'])) {
        $approveid = $_POST['aprove_inquiryid'];
        $userid = $_SESSION['id'];
        date_default_timezone_set("Asia/Manila");
        $datenow = date("y-m-d h:i:sa");
        //Validation: BAWAT 3 APPROVAL SA ISANG ARAW
        $sqlapprove=mysqli_query($con,"
        UPDATE main_table SET status='2', userid='$userid',date_update='$datenow' WHERE 
        main_id='$approveid'");

        $customer_result = mysqli_query($con, "SELECT customer_id from main_table WHERE main_id='$approveid'");

        if (!$customer_result) {
            die("Error");
        }

        $customer_info = mysqli_fetch_assoc($customer_result);
        $customerno = $customer_info["customer_id"];

        $accounts_result= mysqli_query($con, "SELECT lname, fname, email, user, password from user_accounts WHERE customer_no='$customerno'");
        
        if (!$accounts_result) {
            die("Error");
        }
       
        $accounts_info = mysqli_fetch_assoc($accounts_result);
        $fname = $accounts_info["fname"];
        $lname = $accounts_info["lname"];
        $username = $accounts_info["user"];
        $password = $accounts_info["password"];
        $email = $accounts_info["email"];

       if ($sqlapprove) {
            $mailer = new Mailer($email, "Inquiry Approved");
            $mailer->message(MailerTemplate::inquiryApproved($fname, $lname, $username, $password));
            $mailer->send();
            echo "Approve";   
        }else{
            echo "Error";
        }

    }
    
?>