<?php
include('connection.php');

// echo 'hello';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $retypepass = $_POST['retypepass'];
    $customer_no = $_POST['customer_no'];

    // $sql = "UPDATE user_accounts SET password = '$newpass' WHERE customer_no = '$customer_no'";
    $sql = "select password from user_accounts where customer_no = '$customer_no'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored = $row["password"];
        // echo $stored;

        if ($stored == $oldpass) {
            // Validate the new password and confirm password match
            if ($newpass === $retypepass) {
                // Hash the new password
                // $hashedPassword = password_hash($newpass, PASSWORD_DEFAULT);
                $updatepass = $newpass;
                // Update the password in the database for the specified user
                $updateSql = "UPDATE user_accounts SET password = '$updatepass' WHERE customer_no = '$customer_no'";
                if ($con->query($updateSql) === TRUE) {
                    echo "Password Updated Successfully";
                } else {
                    echo "Error updating password: " . $con->error;
                }
            } else {
                echo "New password and confirm password do not match";
            }
        } else {
            echo "Old Password is Incorrect";
        }
    } else {
        echo "User not Found";
    }
}
