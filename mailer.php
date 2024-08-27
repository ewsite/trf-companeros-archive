<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../Homepage/PHPMailer/src/PHPMailer.php';
require '../Homepage/PHPMailer/src/SMTP.php';
require '../Homepage/PHPMailer/src/Exception.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve the email address from the POST data
  $emailed = $_POST['emailed'];

  // Validate the email address (you can add more validation if needed)
  if (!filter_var($emailed, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400); // Bad Request
    echo "Invalid email address";
    exit;
  }

  // Check if the email exists in the database
  $sql = "SELECT * FROM codes WHERE email = '$emailed'";
  $result = mysqli_query($con, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $codes = $row['code'];

    // Send the username and password email
    $mail = new PHPMailer();
    try {
      $mail->isSMTP();
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = 'tls';
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 587;
      $mail->Username = 'saintmarkresort@gmail.com'; // Replace with your Gmail email address
      $mail->Password = 'xcfbdfgkapjtknrs'; // Replace with your Gmail password
      $mail->setFrom('saintmarkresort@gmail.com', 'Saint Mark Resort'); // Replace with your Gmail email address and desired sender name
      $mail->addAddress($emailed); // Add recipient email address

      // Email content
      $message = '
        <table style="border-collapse: collapse; width: 1000px; margin: 0 auto; text-align: center;">
        <tr>
            <td style="font-size: 16px; font-weight: 600; text-align: left; padding: 20px 0;"><strong>Hello ' . $username . ',</strong></td>
        </tr>
        <tr>
            <td style="padding: 30px; background-color: #d97706; border-radius: 4px; font-size: 24px; font-weight: bold; color: #fff;">
                Your account details</td>
        </tr>
        <tr>
            <td style="padding: 30px 0; font-size: 20px;"><strong>Username:</strong> ' . $username . '</td>
        </tr>
        <tr>
            <td style="padding: 0 0 30px; font-size: 20px;"><strong>Password:</strong> ' . $password . '</td>
        </tr>
        <tr>
            <td style="font-size: 16px; font-weight: 600; color: #626262; line-height: 22px;">Please keep this information confidential and do not share it with others.</td>
        </tr>
        <tr>
            <td style="border-bottom: 5px solid #ccc;"></td>
        </tr>
        <tr>
            <td style="margin: 0; text-align: left; font-size: 12px; font-weight: 400; color: #858585; line-height: 22px; padding: 10px 0;">&copy; Jesus Christ Yesterday, Today and Forever. All Rights Reserved.</td>
        </tr>
    </table>';

      $mail->isHTML(true);
      $mail->Subject = 'Account Details';
      $mail->Body = $message;
      $mail->send();

      // Email sent successfully
      http_response_code(200); // OK
      echo "Account details have been sent to your email address.";
      exit;
    } catch (Exception $e) {
      // Failed to send email
      http_response_code(500); // Internal Server Error
      echo "Failed to send account details email.";
      exit;
    }
  } else {
    // Email does not exist in the database
    http_response_code(404); // Not Found
    echo "Email not found";
    exit;
  }
} else {
  http_response_code(405); // Method Not Allowed
  echo "Invalid request method";
  exit;
}
