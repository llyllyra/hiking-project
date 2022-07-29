<?php

$to      = 'lambert.nicolas.22@gmail.com';
$subject = 'le sujet';
$message = 'Bonjour !';
$headers = 'From: dodo@example.com' . "\r\n" .
'Reply-To: dodo@example.com' . "\r\n" .
'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
echo'test';
?>