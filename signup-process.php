<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/lib/mailer/Mailer.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/lib/mailer/MailerTemplate.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	$lname = $_POST['lname'];
	$fname = $_POST['fname'];
	$contact = $_POST['contact'];
	$user = $_POST['user'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];
	if (strlen($password) < 8) {
		echo "Minimum Password length is at least 8 characters";
		return;
	}

	if (strcmp($password, $confirm_password)) {
		echo "Password doesn't match!";
		return;
	}

	// this is aan attempt to get a user credentails to the database
	// to check if newly registered username or email already exists.
	$stmt = $con->prepare("SELECT * FROM user_accounts WHERE email = ? OR user = ?");
	date_default_timezone_set("Asia/Manila");
	$datenow = date("y-m-d h:i:sa");
	$unixdate = strtotime($datenow);
	$stmt->bind_param("ss", $email, $user);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($result->num_rows > 0) {
		// email or username already exists in database
		echo "Email or Username is already exists";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emailErr = "Invalid email format";
		echo $emailErr;
	} else {
		$query = "insert into user_accounts(user, password, lname, fname, date_created, email, contact, customer_no, status) values ('$user', '$password', '$lname', '$fname', NOW(), '$email', $contact, '$unixdate', '1')";
		if (mysqli_query($con, $query)) {
			$mailer = new Mailer($email, "Verify Account");
			$mailer->message(MailerTemplate::signup($user));
			try {
				$mailer->send();
			} catch (Exception $e) {
				echo 'Failed to send email. Error:' . $mail->ErrorInfo;
			}

			echo "Sign-up Successfully";
		}else {
			echo 'ERROR:ERROR';
		}
	}
} else {
	echo 'hindi na post';
}
