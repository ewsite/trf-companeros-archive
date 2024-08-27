<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";;
if (isset($_POST['feedid']) && isset($_POST['clientid'])  
&& isset($_POST['lname'])  && isset($_POST['datesend'])
&& isset($_POST['email']) && isset($_POST['message'])) {
    $feedid = $_POST['feedid'];
    $clientid = $_POST['clientid'];
    $lname = $_POST['lname'];
    $datesend = $_POST['datesend'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $maxRows = 3;
    $sqlpostfeedcheck = mysqli_query($con, "SELECT COUNT(*) AS numrows_feed FROM client_feed WHERE status='1'");
    $result = mysqli_fetch_assoc($sqlpostfeedcheck);
    $currentRows = $result['numrows_feed'];
        // Check if the maximum number of rows has been reached
        if ($currentRows >= $maxRows) {
            echo "Failed";
            
        }else{
            $sqlfeedbackpost = mysqli_query($con, "UPDATE client_feed SET date_send='$datesend', lname='$lname', email='$email',
            message='$message', client_id='$clientid', status='1' WHERE id='$feedid'");
            if ($sqlfeedbackpost) {
                echo "Posted Successfully";
            }else {
                echo "Error inserting row: " . mysqli_error($con);
            }
        }
    
}else{
    echo "hindi na post";
}
