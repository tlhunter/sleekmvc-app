<?php
namespace Sleek;

class Email {
    protected $recipient    = NULL;
    protected $subject      = NULL;
    protected $body         = NULL;
    protected $sender       = NULL;
    protected $lastError    = '';
    protected $html         = NULL;

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

    public function setBody($body) {
        $this->body = $body;
        return $this;
    }

    public function setTypeHtml() {
        $this->html = TRUE;
        return $this;
    }

    public function setTypeText() {
        $this->html = FALSE;
        return $this;
    }

    public function setSender($sender) {
        $sender = trim($sender);
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

    public function send() {
        if ($this->recipient && $this->subject && $this->body && $this->sender) {
            $headers = "From: {$this->sender}";
            if ($this->html) {
                $headers .= "\r\nContent-type: text/html";
            }
            return mail($this->recipient, $this->subject, $this->body, $headers);
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

    public function debug() {
        echo "<pre>";
        var_dump($this);
        echo "</pre>";
        return $this;
    }

}
