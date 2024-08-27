
<?php
    require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";
    if (isset($_POST['inquiryid']) && isset($_POST['customer_id']) ) {
        $inquiryid = $_POST['inquiryid'];
        $customer_id = $_POST['customer_id'];
        date_default_timezone_set("Asia/Manila");
    // $datenow = date_default_timezone_get();
        $datenow = date("y-m-d h:i:sa");
        $userid = $_SESSION['id'];
        $sql = mysqli_query($con, "UPDATE main_table SET customer_id='$customer_id', userid='$userid', date_update='$datenow' WHERE main_id='$inquiryid'");
        if ($sql) {
            echo "succes";
        }else{
            echo "error";
        }
    }



?>