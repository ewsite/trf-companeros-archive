<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once  __DIR__."/../plugins/PHPMailer/src/PHPMailer.php";
require_once  __DIR__."/../plugins/PHPMailer/src/SMTP.php";

class Mailer {
    private PHPMailer $mail;

    private string $message;
    public function __construct(private string $sendto, private string $subject) {
        $this->mail = new PHPMailer();
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mail->Port = 465;
        $this->mail->Subject = $subject;
        $this->mail->Username = 'hoteltrf@gmail.com';
        $this->mail->Password = 'bgctbpzscwwlscry';
        $this->mail->setFrom('hoteltrf@gmail.com','TRF Compañeros Hotel');
        $this->mail->addAddress($sendto);
        $this->mail->isHTML(true);
        $this->mail->ContentType = 'text/html';
        $this->mail->CharSet = 'UTF-8';
    }

    public function message(string $message) {
        $this->message = $message;
    }

    public function send(): bool {
        if ($this->message == null) {
            return false;
        }
        $this->mail->Body = $this->message;
        $this->mail->Send();
        return true;
    }
}

?>