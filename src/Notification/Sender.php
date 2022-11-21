<?php

namespace App\Notification;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\User\UserInterface;

class Sender
{
    public function sendUserNotificationToAdmin(UserInterface $user)
    {
        file_put_contents('debug.txt', $user->getEmail());

    }
}