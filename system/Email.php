<?php
class Email {
    protected $recipient;
    protected $subject;
    protected $body;
    protected $sender;

    public function __construct($recipient, $subject, $body, $sender) {
        if ($recipient) {
            $this->recipient = $recipient;
        }
        if ($subject) {
            $this->subject = $subject;
        }
        if ($body) {
            $this->body = $body;
        }
        if ($sender) {
            $this->sender = $sender;
        }
    }

    public function setRecipient($recipient) {
        $this->recipient = $recipient;
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

    public function setSender($sender) {
        $this->sender = $sender;
        return $this;
    }

    public function send() {
        return mail($this->recipient, $this->subject, $this->body, "From: {$this->sender}");
    }

}
