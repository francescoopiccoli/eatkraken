<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/PHPMailer/src/Exception.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/PHPMailer/src/PHPMailer.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/libs/PHPMailer/src/SMTP.php");

function simple_email($addr, $title, $body){
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.sendgrid.net';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'info.eatkraken@gmail.com';                     // SMTP username
        $mail->Password   = 'eatkraken2020';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('info.eatkraken@gmail.com', 'EatKraken');
            $mail->addAddress($addr);     // Add a recipient

        // Content

        $mail->isHTML(true); 

        $mail->Subject = $title;
        $mail->Body    = $body;
        $mail->AltBody = $body;
        
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>