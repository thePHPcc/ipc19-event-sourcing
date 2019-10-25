<?php declare(strict_types = 1);
namespace Eventsourcing;

class MailService {
    public function send(Mail $mail): void {
        print \sprintf("Sending mail with subject '%s' to %s... \n", $mail->getSubject(), $mail->getRecipientAddress());
        \sleep(2);
        print \sprintf("Mail sent. \n", $mail->getRecipientAddress());
    }
}
