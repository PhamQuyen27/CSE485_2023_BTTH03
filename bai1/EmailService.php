<?php
class EmailService
{
    private $emailSender;

    public function __construct(EmailSenderInterface $emailSender)
    {
        $this->emailSender = $emailSender;
    }

    public function sendEmail($to, $subject, $message)
    {
        $this->emailSender->sendEmail($to, $subject, $message);
    }
}