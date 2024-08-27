<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";;
    if (isset($_POST['retrieve_inquiry'])) {
        $retrieve_inquiry = $_POST['retrieve_inquiry'];
        $sqlretrieve = mysqli_query($con,"UPDATE main_table SET status='1' WHERE main_id='$retrieve_inquiry'");
        if ($sqlretrieve) {
            echo "Success:Deleted";
        }else{
            echo "Error:Error";
        }
    }
?>