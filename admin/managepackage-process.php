<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";
if (isset($_POST['modifiedPackageData']) && isset($_POST['room_no'])) {
    $room_no= $_POST['room_no'];
    $result = mysqli_query($con, "SELECT price_list from rooms WHERE id='$room_no'");

    $package = mysqli_fetch_assoc($result);
    $price_lists = json_decode($package['price_list'], true);
    $modified_price_list = json_decode($_POST['modifiedPackageData'], true);

    foreach ($modified_price_list as $value => $furina) {
        foreach ($price_lists as $index => $price_list) {
            if ($price_list["duration"] == $value) {
                $price_lists[$index]["price"] = intval($furina);
                break;
            }
        }
    }

    $price_lists_json = json_encode($price_lists);
    $sqlmanagepkg = mysqli_query($con,"UPDATE rooms SET price_list = '$price_lists_json' WHERE room_no='$room_no'");
    
    if ($sqlmanagepkg) {
        echo "Success";   
    }else{
        echo $room_no. " failed to update.";
    }
}else{
    echo "Hindi na Post";
}
?>