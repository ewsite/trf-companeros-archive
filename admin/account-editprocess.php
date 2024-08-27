<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";
if (isset($_POST['customerno']) 
&& isset($_POST['edituser']) 
&& isset($_POST['editlname']) 
&& isset($_POST['editfname'])
&& isset($_POST['editpass'])
&& isset($_POST['editcontact'])
&& isset($_POST['editemail'])){
    $customerno = $_POST['customerno'];
    $user = $_POST['edituser'];
    $lname = $_POST['editlname'];
    $fname = $_POST['editfname'];
    $pass = $_POST['editpass'];
    $contact = $_POST['editcontact'];
    $email = $_POST['editemail'];
    $userid = $_SESSION['id'];
    date_default_timezone_set("Asia/Manila");
    $datenow = date("y-m-d h:i:sa");
    $sqleditsave = mysqli_query($con, "UPDATE user_accounts 
    SET user_id=$userid, date_updated='$datenow', 
    fname='$fname', lname='$lname', password='$pass', user_id='$userid',
    contact='$contact',email='$email' WHERE customer_no='$customerno'
    ");
    if ($sqleditsave) {
        echo "Success";   
    }else{
        echo "Error";
    }

}else{
    echo "Hindi na Post";
}
?>