<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Mailer = "smtp";                   // Set mailer to use SMTP

$mail->SMTPDebug = 1;                     // Enable verbose debug output
$mail->SMTPAuth = TRUE;                   // Enable SMTP authentication
$mail->SMTPSecure = "tls";                // Enable TLS encryption, 'ssl' (a predecessor to TSL) is also accepted
$mail->Port = 587;                        // TCP port to connect to (587 is a standard port for SMTP)
$mail->Host = "smtp.gmail.com";           // Specify main and backup SMTP servers
$mail->Username = "randodev02@gmail.com";  // SMTP username
$mail->Password = 'chimciwjsvlnbtsb';         // SMTP password

$mail->setFrom('randodev02@gmail.com', 'randoDev');
$mail->addAddress('llyllyrallylly@gmail.com', 'name-is-optional');

$mail->isHTML(true);                      // Set email format to HTML
$mail->Subject = 'Thanks for your subscription';
$mail->Body    = 'Nico, Dorian et marlene';

$mail->send();