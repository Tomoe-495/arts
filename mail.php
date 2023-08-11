<?php

function verificationCode($length=32) {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $string = '';
    $characterCount = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[rand(0, $characterCount - 1)];
    }

    return $string;
}

$type = $_GET["type"];

if($type == "contact"){
    $email = "hasnain2202e@aptechsite.net";
    $Username = "Arts Contact form";
    $m_username = $_POST["username"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $m_email = $_POST["email"];

    $Altmessage = "From: $m_email \n Username: $m_username \n Message: $message";
    $message = "<b>From:</b> $m_email
                <br>
                <b>Username:</b> $m_username
                <br>
                <b>Message:</b> $message
    ";

}else if($type == "register"){
    $email = $_GET["email"];
    $Username = $_GET["username"];
    $password = $_GET["password"];
    $subject = "Arts Email Verification";
    $Password = md5($password);
    $verification = verificationCode();

    include "dbcon.php";

    $sql = "select * from accounts where email = '$email'";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_num_rows($result);
    if($row > 0){
        setcookie("register", "registered", time()+10);
        header("location: login.php");
    }else{

        $sql = "insert into accounts(username, email, password, verification_token) 
        values('$Username', '$email', '$Password', '$verification')";
        
        
        mysqli_query($conn, $sql);
        
        $sql = "select * from accounts where verification_token = '$verification' limit 1";
        
        $result = mysqli_query($conn, $sql);
        
        $row = mysqli_fetch_assoc($result);
        
        $id = $row["id"];
        
        $link = "localhost:5500/verify.php?id=$id&token=$verification";
        
        $message = "click here to verify your accounts -> $link";
        $Altmessage = "click here to verify your accounts -> $link";
    }

}

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

$mail->setFrom('hasnain2202e@aptechsite.net', 'Arts');		
// $mail->addAddress('receiver1@gfg.com');
$mail->addAddress($email, $Username);

$mail->isHTML(true);
$mail->Subject = $subject;
$mail->Body = $message;
$mail->AltBody = $Altmessage;
$mail->send();
// echo "Mail has been sent successfully!";

if($type == "register"){
    setcookie("register", "verify", time()+5);
    header("location: login.php");
}else if($type == "contact"){
    setcookie("register", "sent", time()+5);
    header("location: contact.php");
}

?>
