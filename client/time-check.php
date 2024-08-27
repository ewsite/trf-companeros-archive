<?php

if (
    isset($_POST['timecheck']) &&
    isset($_POST['datecheck'])
) {
    $timecheck = $_POST['timecheck'];
    $datecheck = $_POST['datecheck'];
    require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";;
    $meronna = false;
    $status = array(1, 2, 6);
    for ($i = 0; $i < count($status); $i++) {
        $sqldate = mysqli_query($con, "SELECT * FROM main_table WHERE 
            package_time ='$timecheck'AND expected_date='$datecheck' AND status='$status[$i]'");
        if (mysqli_num_rows($sqldate)) {
            $meronna = true;
        }
    }
    if ($meronna) {
        echo "Unavailable";
    } else {
        echo "Available";
    }
} else {
    echo "hindi na post";
}
