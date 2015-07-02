<?php

namespace Framework\Library;

/**
 * Class Emailer
 * @package Framework
 * @author Denzyl Dick<denzyl@live.nl>
 */
class Emailer
{

    private $body;
    private $subject;
    private $type;
    private $recipients = array();
    private $sender = array();
    private $swift_Message;

    /**
     * @param Swift_SmtpTransport $transport
     */
    public function __construct(\Swift_SmtpTransport $transport)
    {
        $this->swift_Message = \Swift_Message::newInstance();
        $this->swift_Mailer = \Swift_Mailer::newInstance($transport);
    }

    /**
     * Set an attachment to the message.
     * @param $file
     * @return $this
     * @throws \Exception
     */
    public function setAttachment($file)
    {
        if (file_exists($file)) {
            $this->swift_Message->attach(Swift_Attachment::fromPath($file));
            return $this;
        } else {
            throw new \Exception("$file doesn't exists.");
        }
    }

    /**
     * @param array $recipients
     * @return $this
     */
    public function setRecipients(array $recipients)
    {
        $this->recipients = $recipients;
        return $this;
    }

    /**
     * Build message then send message.
     * @return mixed
     */
    public function send()
    {
        $this->buildMessage();
        try {
            return $this->swift_Mailer->send($this->swift_Message);
        } catch (\Exception $e) {
            /*
            *Logger
            */

        }
    }

    /**
     * Build message
     * @return $this
     */
    private function buildMessage()
    {
        $this->swift_Message
            ->setSubject($this->getSubject())
            ->setFrom($this->getSender())
            ->setTo($this->getRecipments())
            ->setBody($this->getBody(), $this->getType());
        return $this;
    }

    /**
     * Get the subject
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * set subject
     * @param $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Get the sender
     * @return array
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set senders
     * @param array $sender
     * @return $this
     */
    public function setSender(array $sender)
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * Get recipients
     * @return array
     */
    public function getRecipments()
    {
        return $this->recipients;
    }

    /**
     * Get body
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set body
     * @param $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Get type of email
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

}
