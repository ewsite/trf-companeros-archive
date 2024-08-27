<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "trfhoteldb";


try {
	$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
} catch (Exception $e) {

	print("Connect to the database caught error.<br/>Check credentials in connection.php.<br/>");
	print("Log<br/>");
	die($e);
}

if (session_status() == PHP_SESSION_DISABLED || session_status() == PHP_SESSION_NONE) {
	// Starts a session
	session_start();
}
?>