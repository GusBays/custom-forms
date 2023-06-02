<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

abstract class BaseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function via(): array
    {
        return ['mail'];
    }

    public function getEmailFromAddress(): string
    {
        return env('MAIL_FROM_ADDRESS');
    }

    public function getName(): string
    {
        return env('APP_NAME');
    }

    abstract function getSubject(): string;

    abstract function toMail(): MailMessage;

    abstract function getReplyTo(): array;

    abstract function getArgs(): array;
}