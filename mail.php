<?php

use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->Host	 = 'smtp.gmail.com;';				
$mail->SMTPAuth = true;							
$mail->Username = 'hasnain2202e@aptechsite.net';				
$mail->Password = 'Has562001^';					
$mail->SMTPSecure = 'tls';							
$mail->Port	 = 587;

$mail->setFrom('hasnain2202e@aptechsite.net', 'PHPMailer');		
// $mail->addAddress('receiver1@gfg.com');
$mail->addAddress('hasnainsiddique495@gmail.com', 'Name');

$mail->isHTML(true);								
$mail->Subject = 'Subject';
$mail->Body = 'HTML message body in <b>bold</b> ';
$mail->AltBody = 'Body in plain text for non-HTML mail clients';
$mail->send();
echo "Mail has been sent successfully!";

?>
