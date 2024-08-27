<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";
    if (isset($_POST['delete_account'])) {
        $delete_account = $_POST['delete_account'];
        $sqldeleteacc = mysqli_query($con,"UPDATE user_accounts SET status='0' WHERE id='$delete_account'");
        if ($sqldeleteacc) {
            echo "Success:Account Deleted";
        }else{
            echo "Error:Error";
        }
    }
?>