<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require($_SERVER['DOCUMENT_ROOT'].'/../vendor/phpmailer/phpmailer/src/Exception.php');
require($_SERVER['DOCUMENT_ROOT'].'/../vendor/phpmailer/phpmailer/src/PHPMailer.php');
require($_SERVER['DOCUMENT_ROOT'].'/../vendor/phpmailer/phpmailer/src/SMTP.php');

function sendMail($emailTo, $nameTo, $content) {
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    $mail->SMTPDebug  = 1;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "hpmduc3010@gmail.com";
    $mail->Password   = "minhduc1999";
    $mail->IsHTML(true);
    
    $mail->AddAddress($emailTo, $nameTo);
    $mail->SetFrom("hpmduc3010@gmail.com", "Công Ty 3DM");
    $mail->AddReplyTo("minhducducminh1999@gmail.com", "reply-to-name");
    $mail->AddCC("hpmduc1999@gmail.com", "cc-recipient-name");
    
    $mail->Subject = "Don dat hang";
    
    $mail->MsgHTML($content); 
    if(!$mail->Send()) {
        echo "Error while sending Email.";
        var_dump($mail);
    } else {
        echo "Email sent successfully";
    }
}