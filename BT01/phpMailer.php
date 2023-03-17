<?php
// require_once 'vendor/autoload.php';
// require_once 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
// require_once 'vendor/phpmailer/phpmailer/src/SMTP.php';

include "../vendor/phpmailer/phpmailer/src/PHPMailer.php";
include "../vendor/phpmailer/phpmailer/src/Exception.php";
include "../vendor/phpmailer/phpmailer/src/POP3.php";
include "../vendor/phpmailer/phpmailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

interface EmailServerInterface {
	public function sendEmail($to, $subject, $message);
}

class EmailSender {
    private $emailServer;

    public function __construct(EmailServerInterface $emailServer) {
        $this->emailServer = $emailServer;
    }

    public function send($to, $subject, $message) {
        $this->emailServer->sendEmail($to, $subject, $message);
    }
}

class GmailEmailServer implements EmailServerInterface {
    private $username;
    private $password;
    
    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = $password;
    }
    
    public function sendEmail($to, $subject, $message) {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = $this->username; //email của bạn                    
            $mail->Password   = $this->password; // password của bạn             
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         
            $mail->Port       = 587;                                    

            //Recipients
            $mail->setFrom($this->username, 'Mailer');
            $mail->addAddress($to);              

            //Content
            $mail->isHTML(true);                                  
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}

// $emailServer = new GmailEmailServer('quyenpham27122002@gmail.com', 'tpcwzqztgaqrayto');
// $emailSender = new EmailSender($emailServer);
// $emailSender->send("quyenpham0712@gmail.com", "Test Email", "This is a test email.");
