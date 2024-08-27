<?php 

require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

if (isset($_POST['pck'])&& isset($_POST['time'])) {
    $packageno = $_POST['pck'];
    $time = $_POST['time'];

    $sqlseeinclusion = mysqli_query($con,"SELECT * FROM packages WHERE packageno = '$packageno' and timeid = '$time' ");
    
    $result = mysqli_fetch_assoc($sqlseeinclusion);
    if ($result) {
        $_SESSION['desc'] = $result['inclusion'];
    }
}
?>