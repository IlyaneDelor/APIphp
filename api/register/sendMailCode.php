<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../../PHPMailer-master/src/Exception.php';
require_once '../../PHPMailer-master/src/PHPMailer.php';
require_once '../../PHPMailer-master/src/SMTP.php';





//require 'src/Exception.php';
//require 'src/PHPMailer.php';
//require 'src/SMTP.php';

$mail = new PHPMailer;
//$mail->isSendmail();
$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "smtp.gmail.com"; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = 587; // TLS only
$mail->SMTPSecure = 'tls'; // ssl is depracated
$mail->SMTPAuth = true;
$mail->Username = 'pomocservicesmail@gmail.com';
$mail->Password = 'AZERtyui77';
$mail->setFrom('pomocservicesmail@gmail.com', 'toto');
$mail->addAddress('tlemaire1610@gmail.com', 'toto2');
$mail->Subject = 'PHPMailer GMail SMTP test';
$mail->msgHTML("test body"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
$mail->AltBody = 'HTML messaging not supported';
// $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

if(!$mail->send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
}else{
    echo "Message sent!";
}



// Send the message, check for errors
//if(!$mail->send())
//{
//    echo "Mailer Error: " . $mail->ErrorInfo;
//}else {
//    echo "ok";
//}

exit();
