<?php


use PHPMailer\PHPMailer\PHPMailer;

require_once "Mailer/PHPMailer.php";
require_once "Mailer/SMTP.php";
require_once "Mailer/Exception.php";

class sendmail
{

    function sendemailOtp($email)
    {

        $otp = rand(100000, 999999);

        $_SESSION["emailotp"] = $otp;
        

        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "prince.singh55989@gmail.com";
        $mail->Password = "@prince@1234";
        $mail->Port = 465;
        $mail->SMTPSecure = "ssl";

        $mail->isHTML(true);
        $mail->setFrom($email, $email);
        $mail->addaddress($email);

        $mail->Subject = ("Get Ready");
        $mail->Body = 'Hey Buddy Your OTP ' . $otp;

        $result=$mail->send();
        if ($result == true) {
            return $result;
        } else {
            return $result;
        }
    }
}
