<?php

require_once __DIR__."/../lib/mailer/Mailer.php";
require_once __DIR__."/../lib/mailer/MailerTemplate.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

if (
    isset($_POST['expecteddate']) &&
    isset($_POST['stayduration']) &&
    isset($_POST['packageno'])
) {
    $customerid = $_SESSION['customer_no'];
    $lname = $_SESSION['lname'];
    $fname = $_SESSION['fname'];
    $email = $_SESSION['email'];
    $contact = $_SESSION['contact'];
    $exptddate = $_POST['expecteddate'];
    $package = $_POST['packageno'];
    $room_no = $_POST['room_no'];
    $person = $_POST['person'];
    $stayduration = $_POST['stayduration'];

    date_default_timezone_set("Asia/Manila");
    $datenow = date("y-m-d h:i:sa");
    mysqli_query($con, "COMMIT");

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
        $sqlreservenow = mysqli_query($con, "INSERT INTO main_table (customer_id, lname, fname, cpnumber, email, date_created, package,  expected_date, customer_price, stay_duration, status, room_no, person)VALUES($customerid, '$lname', '$fname', '$contact', '$email', '$datenow', '$package', '$exptddate', '$price', '$stayduration', '2', '$room_no', '$person')");
    }
    
    if ($sqlreservenow) {
        // Get package information (package_name only)
        $mail = new Mailer($email, "Pending Confirmation of Reservation");
        $mail->message(MailerTemplate::reservation($fname, $lname, $room_no, 0, $exptddate, $stayduration." hours"));
        try {
            $mail->send();
        } catch (Exception $e) {
            echo "Internal Error: ";
            print $e;
        }
        echo "Success";
    } else {
        echo "There is a problem with your form.";
    }
} else {
    echo "Missing variable.";
}
