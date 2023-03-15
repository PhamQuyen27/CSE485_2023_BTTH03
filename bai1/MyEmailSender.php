<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
class MyEmailSender implements EmailSenderInterface
{
    private $smtpServer;
    private $smtpPort;
    private $smtpUsername;
    private $smtpPassword;

    public function __construct($smtpServer, $smtpPort, $smtpUsername, $smtpPassword)
    {
        $this->smtpServer = $smtpServer;
        $this->smtpPort = $smtpPort;
        $this->smtpUsername = $smtpUsername;
        $this->smtpPassword = $smtpPassword;
    }

    public function sendEmail($to, $subject, $message)
{
    require_once 'vendor/autoload.php'; 

    $mail = new PHPMailer(true); 

    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = $this->smtpServer;
    $mail->Port = $this->smtpPort;
    $mail->SMTPAuth = true;
    $mail->Username = $this->smtpUsername;
    $mail->Password = $this->smtpPassword;
    $mail->SMTPSecure = 'tls';

    // Email content
    $mail->setFrom($this->smtpUsername);
    $mail->addAddress($to);
    $mail->Subject = $subject;
    $mail->Body = $message;

    // Send the email
    $mail->send();
    if(!$mail->send()) {
        echo 'Email could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Email has been sent.';
    }
    
}
}