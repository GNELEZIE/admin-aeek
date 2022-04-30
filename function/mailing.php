<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'mailer/vendor/phpmailer/src/Exception.php';
require 'mailer/vendor/phpmailer/src/PHPMailer.php';
require 'mailer/vendor/phpmailer/src/SMTP.php';
require 'mailer/vendor/autoload.php';


if(!function_exists('sendMailNoReply')){
    function sendMailNoReply($to,$subject,$message){
        $mail = new PHPMailer(true);
        try {
            //Server settings

            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'zie.nanien@gmail.com';
            $mail->Password   = '46859936';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 587;

            $mail->setFrom('no-reply@ecoldecroshi.ci', 'Ecoldecroshi');
            $mail->addAddress($to);
            $mail->addReplyTo('no-reply@ecoldecroshi.ci', 'Ecoldecroshi');

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
           return 'send';
        } catch (Exception $e) {
            return $mail->ErrorInfo;
        }
    }
}

if(!function_exists('sendMailTo')){
    function sendMailTo($to,$subject,$message){
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host       = 'mail.ecoldecroshi.ci';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'zie.nanien@gmail.com';
            $mail->Password   = 'vUzwX55sVV-hiebbM';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->setFrom('zie.nanien@gmail.com', 'Ecoldecroshi');
            $mail->addAddress($to);
            $mail->addReplyTo('zie.nanien@gmail.com', 'Ecoldecroshi');

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
           return 'send';
        } catch (Exception $e) {
            return $mail->ErrorInfo;
        }
    }
}

if(!function_exists('sendMailToMe')){
    function sendMailToMe($from,$fromName,$subject,$message){
        $mail = new PHPMailer(true);
        try {
            $mail->CharSet = 'UTF-8';
            $mail->SMTPDebug = 0;
            $mail->setFrom($from, $fromName);
            $mail->addReplyTo($from, $fromName);
            $mail->addAddress('zie.nanien@gmail.com', 'Ecoldecroshi');

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
           return 'send';
        } catch (Exception $e) {
            return $mail->ErrorInfo;
        }
    }
}

