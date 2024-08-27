<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/connection.php";
$error = array();

    $mode = "enter_email";
    if(isset($_GET['mode'])){
        $mode = $_GET['mode'];
    }
    
    // something is posted
    if(count($_POST) > 0){

        switch ($mode) {
            case 'enter_email':
                //code.....
                $email = $_POST['email'];
                // validate email
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $error[] = "Please enter a valid email";
                }elseif(!valid_email($email)){
                    $error[] = "Email was not found";
                }else{
                    $_SESSION['forgot']['email'] = $email;
                    send_email($email);
                    header("Location: forgot.php?mode=enter_code");
                    die;
                }
                break;
            // 
            case 'enter_code':
                //code.....
                $code = $_POST['code'];
                // is_code_correct($code);
                $result = is_code_correct($code);

                if($result == "The code is correct"){
                    $_SESSION['forgot']['code'] = $code;
                    header("Location: forgot.php?mode=enter_password");
                    die;
                }else{
                    $error[] = $result;
                }
                break;
            // 
            case 'enter_password':
                //code.....
                $password = $_POST['password'];
                $password2 = $_POST['password2'];
            
                if($password !== $password2){
                    $error[] = "Password do not match";
                }elseif(!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])){
                    header("Location: index.php");
                    die;
                }else{
                    save_password($password);
                    if(isset($_SESSION['forgot'])){
                        unset($_SESSION['forgot']);
                    }
                    header("Location: index.php");
                    die;
                }
                break;

            default:
                //code....
                break;
        }
    }
    function send_email($email){
        global $con;

        $expire = time() + (60 * 1);
        $code = rand(10000,99999);
        $email = addslashes($email);

        $query = "insert into codes (email,code,expired) value ('$email','$code','$expire')";
        mysqli_query($con, $query);

        // send email here
        // send_mail ($email,'Password reset', "Your Code is " . $code);
        $sql = "SELECT * FROM codes WHERE email='$email'";

		$result = mysqli_query($con, $sql);

		if (mysqli_num_rows($result)) {
			// $otp = "";
			// $numbers = array();
			// for ($i = 0; $i < 6; $i++) {
			// $otp .= rand(1,9); // Generates a random number between 1 and 9 (inclusive)
			// }
			
			// echo $otp;
			
			$row = mysqli_fetch_assoc($result);
			if ($row['email'] === $email && $row['code'] === $code) {
				$_SESSION['code'] = $row['code'];
				$_SESSION['email'] = $row['email'];
				$useremail = $_SESSION['email'];

				$_SESSION['id'] = $row['id'];
				$userid = $row['id'];
				mysqli_query($con, "update codes set code = '$code', expired = '$expire' where id = '$userid'");
				require './phpmailer/includes/PHPMailer.php';
				require './phpmailer/includes/SMTP.php';
				require './phpmailer/includes/Exception.php';
				$mail = new PHPMailer\PHPMailer\PHPMailer();

				try {
					$mail->isSMTP();
					$mail->SMTPAuth = true;
					$mail->SMTPSecure = 'tls';
					$mail->Host = 'smtp.gmail.com';
					$mail->Port = 587;
					$mail->Username = 'saintmarkresort@gmail.com';
					$mail->Password = 'xcfbdfgkapjtknrs';
					$mail->setFrom('saintmarkresort@gmail.com', 'Saint Mark Resort');
					$mail->addAddress($useremail);
					

					//Table
					// $table = '<table style="border-collapse: collapse; width: 1000px; height margin: 0 auto; text-align: center;">';
					// // $table .= '<tr style="background-color: #d97706;">';
					// $table .= '<center>';
					// $table .= '<tr>';
					// $table .= '<td style="font-size:16px; ; font-weight:600; text-align:left;"><strong>Hello ' . $uname . ', <br>To complete JCYTF verification, please use the code: </br></strong></td>';
					// $table .= '</tr>';
					// $table .= '<tr>';
					// $table .= '<td style="padding: 30px; background-color: #d97706; height:96px; margin-top:20px; border-radius:4px; line-height: 96px; text-align:center; font-size: 32px; font-weight:900p;"><strong>' . $otp . '</strong></td>';
					// $table .= '</tr>';
					// $table .= '<td style="font-size:12px; font-weight:600; color:#626262; line-height: 17px; margin-top: 20px; margin:0;">The code can be used only once and will expire in 2 minutes. If you didn\'t request the code, please disregard this email. This is an automatically generated email, please do not reply to it.</td>';
					// $table .= '<tr style="border-bottom: 5px solid #ccc;">';
					// $table .= '<td style="margin: 0; text-align: left; font-size:12px; font-weight:400; color: #858585; line-height:17px;">© Jesus Christ Yesterday, Today and Forever All Right Reserved.</td>';
					// $table .= '</tr>';
					// $table .= '</center>';
					// $table .= '</table>';

					$mail->isHTML(true);
					// $mail->Body = $table;

					$mail->ContentType = 'text/html';
					$mail->CharSet = 'UTF-8';
					$mail->send();
					echo 'Correct';
				} catch (Exception $e) {
					echo 'Failed to send email. Error:' . $mail->ErrorInfo;

				}
			} else {
				echo 'error';
			}
		} else {
			echo 'Error';
			
		}
    }
    // 
    function save_password($password){
        global $con;

        // $password = password_hash($password, PASSWORD_DEFAULT);
        $email = addslashes($_SESSION['forgot']['email']);

        $query = "update user_accounts set password = '$password' where email = '$email' limit 1";
        mysqli_query($con, $query);

    }
    // 
    function valid_email($email){
        global $con;

        $email = addslashes($email);

        $query = "select * from user_accounts where email = '$email' limit 1";
        $result = mysqli_query($con, $query);
        if($result){
            if(mysqli_num_rows($result) > 0)
            {
                    return true;
            }
        }
        return false;
    }
    // 
    function is_code_correct($code){
        global $con;
        
        $code = addslashes($code);
        $expire = time();
        $email = addslashes($_SESSION['forgot']['email']);
        $query = "select * from codes where code = '$code' && email = '$email' && expired > '$expire' order by id desc limit 1";
        $result = mysqli_query($con, $query);
        if($result){
            if(mysqli_num_rows($result) > 0)
            {
                $row = mysqli_fetch_assoc($result);
                if($row['expired'] > $expire){
                    return "The code is correct";
                }else{
                    return "The code is expired";
                }
            }else{
                return "The code is incorrect";
            }
        }
        return "The code is incorrect";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="forgot.css">
    <link rel="icon" href="favicon.png">
    <title>Forgot Password</title>
</head>
<body>
    <?php
        switch ($mode) {
            case 'enter_email':
                //code.....
                ?>
                    <form method="post" action="forgot.php?mode=enter_email" class="email">
                        <img src="W.png">
                        <div class="container">
                            <h1>FORGOT PASSWORD</h1><br>
                            <span class="email">
                            <?php
                                foreach ($error as $error){
                                    //code.....
                                    echo $error . "<br>";
                                } 
                            ?>
                            </span><br>
                            <input type="email" class="input-field" placeholder="Enter your Email" name="email"><br>
                            <br>
                            <input type="submit" value="Send Codes" class="next"><br>
                            <br>
                        <div class="back"><a href="index.php">Back to Log In</a></div>
                        </div>
                    </form>
                <?php
                break;
            case 'enter_code':
                //code.....
                ?>
                    <form method="post" action="forgot.php?mode=enter_code" class="code">
                        <img src="W.png">
                        <div class="container">
                            <h1>FORGOT PASSWORD</h1><br>
                            <span class="code">
                            <?php
                                foreach ($error as $error){
                                    //code.....
                                    echo $error . "<br>";
                                } 
                            ?>
                            </span><br>
                            <input type="text" class="input-field" placeholder="Enter the code sent to your Email" name="code"><br>
                            <br>
                            <input type="submit" value="Next" class="re"><br>
                            <br>
                            <div class="back"><a href="index.php">Back to Log In</a></div>
                        </div>
                    </form>
                <?php
                break;
            case 'enter_password':
                //code.....
                ?>
                    <form method="post" action="forgot.php?mode=enter_password" class="password">
                        <img src="W.png">
                        <div class="container">
                            <h1>FORGOT PASSWORD</h1><br>
                            <span class="password">
                            <?php
                                foreach ($error as $error){
                                    //code.....
                                    echo $error . "<br>";
                                } 
                            ?>
                            </span><br>
                            <input type="text" class="input-field" placeholder="Enter your new password" name="password"><br>
                            <br>
                            <input type="text" class="input-field" placeholder="Enter retype-password" name="password2"><br>
                            <br>
                            <input type="submit" value="Reset password" class="next"><br>
                            <br>
                            <div class="back"><a href="index.php">Back to Log In</a></div>
                        </div>
                    </form>
                <?php
                break;
            default:
                //code....
                break;
        }
    ?>
</body>
</html>