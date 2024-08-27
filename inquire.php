<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {
	// Prepare the data
	$fullname = $_POST['inquiry_fullname'];
	$email = $_POST['email'];
	$contact = $_POST['cpnumber'];
	$message = $_POST['message'] ?? " ";
	if (!empty($fullname) && 
		!empty($email) && 
		!empty($contact)
		) {

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
			echo $emailErr;
		} else {
			$sql = "insert into main_table (inquiry_fullname, email, cpnumber, message, date_created, status) values ('$fullname', '$email', '$contact', '$message', NOW(), '1')";
			if (mysqli_query($con, $sql)) {
				echo "Success";
			} else {
				echo "Error inserting data";
			}
		}
	} else {
		echo 'Invalid Data';
	}

}else{
	echo 'Invalid Request Method';
}

