<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {
	// Prepare the data
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$packageno = $_POST['packageno'];
	$room_no = $_POST['room_no'];
	$person = $_POST['person'];
	$stayduration = $_POST['stayduration'];
	$expecteddate = $_POST['expecteddate'];
	$email = $_POST['email'];
	$contact = $_POST['contact'];
	$message = $_POST['message'] ?? " ";
	if (!empty($expecteddate) && 
		!empty($fname) && 
		!empty($person) && 
		!empty($lname) && 
		!empty($packageno) && 
		!empty($stayduration) && 
		!empty($email) && 
		!empty($contact) &&
		!empty($room_no)
		) {

		$fullname = $fname." ".$lname;
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format";
			echo $emailErr;
		} else {

			$room_info = mysqli_query($con, "SELECT package_no, price_list from rooms where room_no='$room_no'");
			$result = mysqli_fetch_assoc($room_info);
			if(mysqli_num_rows($room_info)){
				$package_name = "Package ".$result['package_no'];
				$inclusion = json_decode($result['price_list'], true);
				$selected_price = [];
		
				foreach ($inclusion as $inc) {
					if ($inc["duration"] == $stayduration) {
						$selected_price = $inc;
						break;
					}
				}
				$price = $selected_price["price"];
			}

			$sql = "insert into main_table (inquiry_fullname, email, cpnumber, message, person, date_created,status, package, stay_duration, expected_date, room_no, customer_price) values ('$fullname', '$email', '$contact', '$message', '$person', NOW(), '1', '$packageno', '$stayduration', '$expecteddate', '$room_no', '$price')";
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

