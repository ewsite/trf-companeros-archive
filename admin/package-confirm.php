<?php

require_once __DIR__."/../lib/mailer/Mailer.php";
require_once __DIR__."/../lib/mailer/MailerTemplate.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

if (
    isset($_POST['expecteddate']) &&
    isset($_POST['stayduration']) &&
    isset($_POST['packageno'])
) {
    $main_id = $_POST['inquiry_id'];
    $exptddate = $_POST['expecteddate'];
    $package = $_POST['packageno'];
    $room_no = $_POST['room_no'];
    $person = $_POST['person'];
    $stayduration = $_POST['stayduration'];

    date_default_timezone_set("Asia/Manila");
    $datenow = date("y-m-d h:i:sa");
    mysqli_query($con, "COMMIT");

    $room_info = mysqli_query($con, "SELECT package_no, price_list from rooms where room_no='$room_no'");
    $result = mysqli_fetch_assoc($room_info);
    if(mysqli_num_rows($room_info)){
        $package_no = "Package ".$result['package_no'];
        $inclusion = json_decode($result['price_list'], true);
        $selected_price = [];

        foreach ($inclusion as $inc) {
            if ($inc["duration"] == $stayduration) {
                $selected_price = $inc;
                break;
            }
        }
        $price = $selected_price["price"];
        $sqlreservenow = mysqli_query($con, "UPDATE main_table SET customer_price = '$price', expected_date = '$exptddate', package = '$package', room_no = '$room_no', person = '$person' WHERE main_id='$main_id'");
    }
    
    if ($sqlreservenow) {
        echo "Success";
    } else {
        echo "There is a problem with your form.";
    }
} else {
    echo "Missing variable.";
}
