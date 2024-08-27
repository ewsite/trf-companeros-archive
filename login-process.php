<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = $_POST['username'];
    $password = $_POST['password'];

    $sqllogin = mysqli_query($con, "SELECT * FROM user_accounts WHERE user='$user' AND password='$password' AND status='1'");
    if (mysqli_num_rows($sqllogin) > 0) {
        $result = mysqli_fetch_array($sqllogin);
        $_SESSION['customer_no'] = $result['customer_no'];
        $_SESSION['lname'] = $result['lname'];
        $_SESSION['fname'] = $result['fname'];
        $_SESSION['contact'] = $result['contact'];
        $_SESSION['last_activity'] = time();
        $_SESSION['last_click'] = time();
        $_SESSION['email'] = $result['email'];
        $_SESSION['ticket'] = "ticket";
        echo "Success";
    } else {
        echo "Failed";
    }
} else {
    echo "Failed";
}
