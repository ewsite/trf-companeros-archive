<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

if (isset($_POST['delete_inquiry'])) {
    $delete_inquiry = $_POST['delete_inquiry'];
    $sqldelete = mysqli_query($con,"UPDATE main_table SET status='0' WHERE main_id='$delete_inquiry'");
    if ($sqldelete) {
        echo "Success:Deleted";
    }else{
        echo "Error:Error";
    }
}
?>