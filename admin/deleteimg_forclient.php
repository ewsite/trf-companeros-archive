<?php 
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";
if (isset($_POST['inquiryid'])) {
    $inquiryid = $_POST['inquiryid'];
    $sqldeleteimg = mysqli_query($con, "UPDATE main_table SET payment_one_img = NULL WHERE main_id = '$inquiryid'");

    if ($sqldeleteimg) {
       echo "Deleted Successfully";
    }
    else{
        echo "Error Cant Delete";
    }

}else{
    echo "Missing Variable";
}

?>