<?php

namespace core\mailer;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use core\Config;

class Mailer
{
    public $mail;
    protected function __construct() {}


    //todo дописать mailer


    public function getInstance()
    {
        if(empty($this->mail)) {

            $configDB = new Config('.env');

            $this->mail = new PHPMailer(true); // Passing `true` enables exceptions

            //Server settings
            $this->mail->SMTPDebug = $configDB->parseConfig('MAIL_SMTPDebug');    // Enable verbose debug output
            $this->mail->isSMTP();                                                      // Set mailer to use SMTP
            $this->mail->Host = $configDB->parseConfig('MAIL_HOST');              // Specify main and backup SMTP servers
            $this->mail->SMTPAuth = true;                                               // Enable SMTP authentication
            $this->mail->Username = $configDB->parseConfig('MAIL_USERNAME');      // SMTP username
            $this->mail->Password = $configDB->parseConfig('MAIL_PASSWORD');      // SMTP password
            $this->mail->SMTPSecure = $configDB->parseConfig('MAIL_SMTPSecure');  // Enable TLS encryption, `ssl` also accepted
            $this->mail->Port = $configDB->parseConfig('MAIL_PORT');              // TCP port to connect to
        }

        return $this->mail;
    }

    public function send($toMail, $fromAddress, $mailReply, $subject, $body)
    {
        try {

            //Recipients
            $this->mail->setFrom('from@example.com', 'Mailer');
            $this->mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
            $this->mail->addAddress('ellen@example.com');               // Name is optional
            $this->mail->addReplyTo('info@example.com', 'Information');
            $this->mail->addCC('cc@example.com');
            $this->mail->addBCC('bcc@example.com');

            //Attachments
            $this->mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            $this->mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $this->mail->isHTML(true);                                  // Set email format to HTML
            $this->mail->Subject = 'Here is the subject';
            $this->mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $this->mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $this->mail->send();

            echo 'Message has been sent';

        } catch (Exception $e) {

            echo 'Message could not be sent. Mailer Error: ', $this->mail->ErrorInfo;
        }
    }
}