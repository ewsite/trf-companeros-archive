<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page after logout
header("Location:index.php");
exit;
?>
