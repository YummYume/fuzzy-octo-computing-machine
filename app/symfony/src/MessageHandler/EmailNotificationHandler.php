<?php

namespace App\MessageHandler;

use App\Message\EmailNotification;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Mime\Email;

#[AsMessageHandler()]
final class EmailNotificationHandler
{
    public function __construct(private readonly MailerInterface $mailer)
    {
    }

    public function __invoke(EmailNotification $email)
    {
        $email = (new Email())
            ->from($email->from)
            ->to($email->to)
            ->subject($email->subject)
            ->html($email->content)
        ;

        $this->mailer->send($email);
    }
}
