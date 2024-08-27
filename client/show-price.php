<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

if(isset($_POST['room_no']) && isset($_POST['stay_duration'])) {
    $room_no = $_POST['room_no'];
    $stay_duration = $_POST['stay_duration'];

    $qry = mysqli_query($con, "select price_list from rooms where room_no='$room_no'");

    if(mysqli_num_rows($qry)){
        $price_list_json = $qry->fetch_assoc()["price_list"];
        $price_list = json_decode($price_list_json, true);

        foreach ($price_list as $list) {
            if ($list["duration"] == $stay_duration) {
                echo "PHP ".$list["price"].".00";
                return;
            }
        }
        echo "PHP 0.00";
    }else{

        echo mysqli_error($con);
        // echo 'Error';
    } 
}

?>