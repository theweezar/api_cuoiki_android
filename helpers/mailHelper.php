<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require($_SERVER['DOCUMENT_ROOT'].'/../vendor/phpmailer/phpmailer/src/Exception.php');
require($_SERVER['DOCUMENT_ROOT'].'/../vendor/phpmailer/phpmailer/src/PHPMailer.php');
require($_SERVER['DOCUMENT_ROOT'].'/../vendor/phpmailer/phpmailer/src/SMTP.php');

function sendMail($emailTo, $nameTo, $subject, $content) {
    $mail = new PHPMailer(true);
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    // $mail->SMTPDebug  = 0;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "hpmduc3010@gmail.com";
    $mail->Password   = "minhduc1999";
    $mail->IsHTML(true);
    
    $mail->AddAddress($emailTo, $nameTo);
    $mail->SetFrom("hpmduc3010@gmail.com", "3xD Company");
    $mail->AddReplyTo("hpmduc3010@gmail.com", "Minh Duc");
    $mail->AddCC("daiphan308@gmail.com", "Dai");
    
    $mail->Subject = $subject;
    
    $mail->MsgHTML($content); 
    if(!$mail->Send()) {
        // echo "Error while sending Email.";
        return false;
    } else {
        // echo "Email sent successfully";
        return true;
    }
}