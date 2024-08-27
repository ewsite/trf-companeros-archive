<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/lib/mailer/Mailer.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/lib/mailer/MailerTemplate.php";

if (
    isset($_POST['edituser'])
    && isset($_POST['editlname'])
    && isset($_POST['editfname'])
    && isset($_POST['editpass'])
    && isset($_POST['editcontact'])
    && isset($_POST['editemail'])
    && isset($_POST['inquiryid'])
) {
    $main_id = $_POST['inquiryid'];
    $user = $_POST['edituser'];
    $lname = $_POST['editlname'];
    $fname = $_POST['editfname'];
    $pass = $_POST['editpass'];
    $contact = $_POST['editcontact'];
    $email = $_POST['editemail'];
    $userid = $_SESSION['id'];
    date_default_timezone_set("Asia/Manila");
    $datenow = date("y-m-d h:i:sa");
    $customerid = strtotime($datenow);


    $sqlcheckemail = mysqli_query($con, "SELECT * FROM user_accounts WHERE email = '$email' OR user = '$user'");

    if (mysqli_num_rows($sqlcheckemail) > 0) {
        echo "Email or Username is already exists";
    } else {
        $sqleditsave = mysqli_query($con, "INSERT INTO user_accounts(customer_no, date_created, user, fname, lname,
    password, contact, email, status, user_id)VALUES('$customerid', '$datenow', '$user', '$fname', '$lname', '$pass', '$contact', '$email', 1, 1)");
        $sqlnewcusid = mysqli_query($con, "UPDATE main_table SET customer_id='$customerid' WHERE main_id='$main_id'");
        if ($sqleditsave) {
            echo "Account Created Successfully";
        } else {
            echo "Account Create Error";
        }
    }
} else {
    echo "Missing Variable";
}
