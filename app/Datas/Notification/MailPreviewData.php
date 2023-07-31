<?php

namespace App\Datas\Notification;

abstract class MailPreviewData
{
    public function __construct(
        private ?string $mail = null
    )
    {}

    public function getMail(): ?string
    {
        return $this->mail;
    }
}