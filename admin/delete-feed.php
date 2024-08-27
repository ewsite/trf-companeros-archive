<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

if (isset($_POST['delete_feed'])) {

    $delete_feed = $_POST['delete_feed'];
    $sqldeletefeed = mysqli_query($con,"DELETE FROM client_feed  WHERE id='$delete_feed'");
    if ($sqldeletefeed) {
        echo "Success:Deleted";
    }else{
        echo "Error:Error";
    }
}
?>