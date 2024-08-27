<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";
if (isset($_POST['pck'])
&& isset($_POST['time'])) {
    $pckselect = $_POST['pck'];
    $timeselect = $_POST['time'];
    $sqlselect = mysqli_query($con, "SELECT * FROM packages WHERE packageno='$pckselect' AND timeid='$timeselect'");

    if(mysqli_num_rows($sqlselect)){
        $result = mysqli_fetch_array($sqlselect);
        $price = $result['prices'];
        $inclusion = $result['inclusion'];
        $_SESSION['price'] = $price;
        $_SESSION['inclusion'] = $inclusion;
        echo $price;
    }else{
        echo mysqli_error($con);
    }
}else{
    echo "Missing Variable/s";
}
    
?>