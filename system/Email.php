<?php
namespace SleekMVC;

class Email {
    const HTML              = 'html';
    const TEXT              = 'text';

    protected $recipient    = NULL;
    protected $subject      = NULL;
    protected $body         = NULL;
    protected $sender       = NULL;
    protected $lastError    = '';

    public function __construct($recipient = NULL, $subject = NULL, $body = NULL, $sender = NULL) {
        if ($recipient) {
            $this->setRecipient($recipient);
        }
        if ($subject) {
            $this->setSubject($subject);
        }
        if ($body) {
            $this->setBody($body);
        }
        if ($sender) {
            $this->setSender($sender);
        }
    }

    public function setRecipient($recipient) {
        $recipient = trim($recipient);
        if (!filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
            $this->recipient = NULL;
            $this->lastError = "Invalid Email set as Recipient";
        } else {
            $this->recipient = $recipient;
        }
        return $this;
    }

    public function setSubject($subject) {
        $this->subject = $subject;
        return $this;
    }

    public function setBody($body, $type = NULL) {
        // TODO: Handle TEXT/HTML emails
        $this->body = $body;
        return $this;
    }

    public function setSender($sender) {
        $recipient = trim($recipient);
        if (!filter_var($sender, FILTER_VALIDATE_EMAIL)) {
            $this->sender = NULL;
            $this->lastError = "Invalid Email set as Sender";
        } else {
            $this->sender = $sender;
        }
        return $this;
    }

    public function getLastError() {
        return $this->lastError;
    }

    public function send($type = NULL) {
        // TODO: Handle TEXT/HTML emails (if only one type is specified, use that if $type is NULL)
        if ($this->recipient && $this->subject && $this->body && $this->sender) {
            return mail($this->recipient, $this->subject, $this->body, "From: {$this->sender}");
        }
    }

    public function attachFile($filename) {
        // TODO: Handle file attachments
        return $this;
    }

    public function attachFileFromString($filename, $content) {
        // TODO: Handle fiel attachments
        return $this;
    }

}
