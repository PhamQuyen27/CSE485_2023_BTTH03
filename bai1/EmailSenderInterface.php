<?php
interface EmailSenderInterface
{
    public function sendEmail($to, $subject, $message);
}