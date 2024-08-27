<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $passwored = $_POST['passwored'];
    $pass = $_POST['pass'];

    if ($passwored !== $pass) {
        echo "Passwords do not match!";
        // You can redirect the user to the sign-in page or display an error message as needed

    } else if ($passwored == "" && $pass == "") {
        echo "Empty Fields";
    } else {
        // Passwords match, continue with the sign-in process.
        echo "Your Successfully Sign-in";
        // Additional code to handle sign-in logic goes here.
    }
}
