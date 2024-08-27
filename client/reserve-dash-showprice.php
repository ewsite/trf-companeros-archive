<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";
if(isset($_POST['p1']) && isset($_POST['t1'])){

    $price = 0;
    $packageno = $_POST['p1'];
    $selectime = $_POST['t1'];
    // $inclusion = $_POST['inclusion'];
    include ('connection.php');
    $qry = mysqli_query($con, "select * from packages where packageno='$packageno' and timeid='$selectime'");
    if(mysqli_num_rows($qry)){
        $result = mysqli_fetch_array($qry);
        $price = $result['prices'];
        $inclusion = $result['inclusion'];
        $_SESSION['price'] = $price;
        $_SESSION['inclusion'] = $inclusion;
        echo $price;
    }else{
        echo mysqli_error($con);
    }
}
?>