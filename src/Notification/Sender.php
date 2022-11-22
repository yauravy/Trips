<?php

namespace App\Notification;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\User\UserInterface;

class Sender
{
    protected $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendUserNotificationToAdmin(UserInterface $user): void
    {
        //file_put_contents('debug.txt', $user->getEmail());

        $message = new Email();
        $message->from('accounts@trips.com')
            ->to('admin@trips.com')
            ->subject('new account created on trips.com')
            ->html('<h1>New Account Created</h1>email:'.$user->getEmail());

        $this->mailer->send($message);

    }
}