<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

if (isset($_POST['datecheck'])) {
    $datecheck = $_POST['datecheck'];
    $datecheckcus = date('y-m-d', strtotime($datecheck));
    $dalawana = false;
    $status = array(1, 2, 6);
    for ($i = 0; $i < count($status); $i++) {
        $sqldate = mysqli_query($con, "SELECT * FROM main_table WHERE 
            expected_date='$datecheckcus' AND status='$status[$i]'");
        if (mysqli_num_rows($sqldate) >= 2) {
            $dalawana = true;
        }   
    }
    if ($dalawana) {
        echo "Unavailable";
        
    }else{
        echo "Available";
    }
    
   
} else {
    echo "hindi na post";
}
