<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

if (isset($_POST['room_no']) && isset($_POST['main_id'])) {
    $room_no = $_POST["room_no"];
    $main_id = $_POST["main_id"]; // Later

    $sql = mysqli_query($con, "UPDATE rooms SET occupied = 0, reserved = 0, customer_id = NULL WHERE room_no='$room_no'");

    if ($sql) {
        echo "Success";
    }
    else {
        echo "Room $room_no already unoccupied!";
    }

}
else {
    echo "Missing Data";
}
?>