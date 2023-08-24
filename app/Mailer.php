<?php 

namespace App;

use Symfony\Component\Mailer\Envelope;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Transport\TransportInterface;
use Symfony\Component\Mime\RawMessage;

class Mailer implements MailerInterface {
    private $transport;

    public function __construct() {
        $dsn = "smtp://ff850dabb5d629:dbb06c86084162@sandbox.smtp.mailtrap.io:2525";
        $this->transport = Transport::fromDsn($dsn);
    }

    public function send(RawMessage $message, Envelope $envelope = null): void
    {
        $this->transport->send($message, $envelope);
    }
}