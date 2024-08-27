<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";
if (isset($_POST["room_no"]) && isset($_POST["expected_date"])) {
    $room_no = $_POST["room_no"];
    $expected_date = $_POST["expected_date"];
    $sql = mysqli_query($con, "SELECT occupied, reserved FROM main_table WHERE expected_date = '$expected_date' AND room_no = '$room_no'");
    $data = $sql->fetch_assoc();
    
    if (!mysqli_num_rows($sql)) {
        echo "Not Occupied";
        return;
    }

    if ($data["occupied"]) {
        echo "Occupied";
    }
    else if ($data["reserved"]) {
        echo "Reserved";
    }
    else {
        echo "Not Occupied";
    }
} else {
    echo "hindi na post";
}
?>