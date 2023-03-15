<?php
// require 'vendor/autoload.php'; // Load PHPMailer
// use PHPMailer\PHPMailer\PHPMailer;


// interface EmailSenderInterface
// {
//     public function sendEmail($to, $subject, $message);
// }
// class MyEmailSender implements EmailSenderInterface
// {
//     private $smtpServer;
//     private $smtpPort;
//     private $smtpUsername;
//     private $smtpPassword;

//     public function __construct($smtpServer, $smtpPort, $smtpUsername, $smtpPassword)
//     {
//         $this->smtpServer = $smtpServer;
//         $this->smtpPort = $smtpPort;
//         $this->smtpUsername = $smtpUsername;
//         $this->smtpPassword = $smtpPassword;
//     }

//     public function sendEmail($to, $subject, $message)
// {
//     require_once 'vendor/autoload.php'; // Load PHPMailer

//     $mail = new PHPMailer(true); // Create a new PHPMailer instance

//     // SMTP configuration
//     $mail->isSMTP();
//     $mail->Host = $this->smtpServer;
//     $mail->Port = $this->smtpPort;
//     $mail->SMTPAuth = true;
//     $mail->Username = $this->smtpUsername;
//     $mail->Password = $this->smtpPassword;
//     $mail->SMTPSecure = 'tls';

//     // Email content
//     $mail->setFrom($this->smtpUsername);
//     $mail->addAddress($to);
//     $mail->Subject = $subject;
//     $mail->Body = $message;

//     // Send the email
//     $mail->send();
//     if(!$mail->send()) {
//         echo 'Email could not be sent.';
//         echo 'Mailer Error: ' . $mail->ErrorInfo;
//     } else {
//         echo 'Email has been sent.';
//     }
    
// }

// }
// class EmailService
// {
//     private $emailSender;

//     public function __construct(EmailSenderInterface $emailSender)
//     {
//         $this->emailSender = $emailSender;
//     }

//     public function sendEmail($to, $subject, $message)
//     {
//         $this->emailSender->sendEmail($to, $subject, $message);
//     }
// }
require('EmailSenderInterface.php');
require('MyEmailSender.php');
require('EmailService.php');

$emailSender = new MyEmailSender('smtp.gmail.com', 587, 'zedloikiem666@gmail.com', 'ueogrdxjmrpvpbcx');
$emailService = new EmailService($emailSender);
$emailService->sendEmail('zedloikiem666@gmail.com', 'Test Email', 'This is a test email.');
