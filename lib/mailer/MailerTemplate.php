<?php

class MailerTemplate {

    // Signup
    public static function signup(string $username): String {
        return <<<TLE
            <table style="border-collapse: collapse; width: 1000px; height margin: 0 auto; text-align: center;">
                <tr>
                    <td style="font-size:16px; text-align:left;">
                        <strong>
                            Hello $username, <br>
                        </strong>
                        Thank you for choosing <b>TRF Hotel Compañeros!</b><br/><br/>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 30px; background-color: #d97706; height:96px; margin-top:20px; border-radius:4px; line-height: 96px; text-align:center; font-size: 32px; font-weight:900p;">
                        To continue, please <a href="trfhotel.online/login.php">Log In</a>
                    </td>
                </tr>
            </table>
        TLE;
    }

    // Reservation
    public static function reservation(string $first_name, string $last_name, string $room_no, int $time_id, string $date, string $duration) {


        return <<<TLE
        <table style="border-collapse: collapse; width: 1000px; height margin: 0 auto; text-align: center;">
            <tr>
                <td style="font-size:16px; text-align:left;">
                    Hello $first_name $last_name, <br/>
                    Thank you for choosing <b>TRF Hotel Compañeros!</b><br/><br/>
                    This is to confirm that you attempt to reserve a <b>"Room $room_no"</b> on <b>$date</b>.<br/>
                    You selected a stay duration of $duration. 
                    <br/><br/>

                    <b>Scan the QR code to pay your reservation using GCash</b>
                    <br>
                    <img src="trfhotel.online/assets/img/gcash.png" style="width: 192px; height: 192px">
                </td>
            </tr>
        </table>
        TLE;
    }

    // Reservation
    public static function fullyPaid(string $first_name, string $last_name, string $room_no, int $time_id, string $or_number, string $date) {
        return <<<TLE
        <table style="border-collapse: collapse; width: 1000px; height margin: 0 auto; text-align: center;">
            <tr>
                <td style="font-size:16px;text-align:left;">
                    Hello $first_name $last_name, <br/>
                    Thank you for choosing <b>TRF Hotel Compañeros!</b><br/><br/>
                    This is to confirm that your reservation of <b>"Room $room_no"</b> on <b>$date</b> is fully paid with an OR# $or_number.<br/> 
                    <br/><br/>
                </td>
            </tr>
        </table>
        TLE;
    }
    // Reservation
    public static function notFullyPaid(string $first_name, string $last_name, string $room_no, int $time_id, string $or_number, string $date, int $customer_paid_balance, int $balance) {

        $time_label = $time_id == 1 ? "Daytime" : "Nighttime";

        return <<<TLE
        <table style="border-collapse: collapse; width: 1000px; height margin: 0 auto; text-align: center;">
            <tr>
                <td style="font-size:16px; text-align:left;">
                    Hello $first_name $last_name, <br/>
                    Thank you for choosing <b>TRF Hotel Compañeros!</b><br/><br/>
                    This is to confirm that your reservation of <b>"Room $room_no"</b> on <b>$date</b> recevies a payment of $customer_paid_balance with an OR# $or_number.<br/> 
                    <br>
                    The remaining balance is Php.$balance.00
                    <br/><br/>

                    We will contact you this day for the confirmation of your reservation...
                </td>
            </tr>
        </table>
        TLE;
    }
    // Reservation
    public static function restPaid(string $first_name, string $last_name, string $room_no, int $time_id, string $date) {

        return <<<TLE
        <table style="border-collapse: collapse; width: 1000px; height margin: 0 auto; text-align: center;">
            <tr>
                <td style="font-size:16px;text-align:left;">
                    Hello $first_name $last_name, <br/>
                    Thank you for choosing <b>TRF Hotel Compañeros!</b><br/><br/>
                    This is to confirm that your reservation <b>"Room $room_no"</b> on <b>$date</b> is now fully paid.<br/> 
                    <br/><br/>
                </td>
            </tr>
        </table>
        TLE;
    }
    // Inquiry
    public static function inquiryApproved(string $first_name, string $last_name, string $username, string $password) {

        return <<<TLE
        <table style="border-collapse: collapse; width: 1000px; height margin: 0 auto; text-align: center;">
            <tr>
                <td style="font-size:16px; text-align:left;">
                    Hello $first_name $last_name, <br/>
                    Thank you for choosing <b>TRF Hotel Compañeros!</b><br/><br/>
                    This is to confirm that your inquiry was approved.<br/>
                    <hr>
                    Here is your credentials: 
                    Username: <b>$username</b><br>
                    Password: <b>$password</b>
                    <br/><br/>
                </td>
            </tr>
        </table>
        TLE;
    }
}
?>