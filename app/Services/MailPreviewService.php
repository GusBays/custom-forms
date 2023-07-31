<?php

namespace App\Services;

use App\Datas\Notification\MailPreviewData;
use App\Notifications\Admin\FillNotification;
use App\Notifications\Admin\RecoverPasswordNotification;
use App\Notifications\Front\AnswerNotification;
use Illuminate\Notifications\Messages\MailMessage;
use Symfony\Component\HttpFoundation\Response;

class MailPreviewService
{
    public function getMailPreview(MailPreviewData $data): MailMessage
    {
        $notification = $this->getNotificationInstanceBy($data->getMail());

        if (blank($notification)) throw new \Exception('notification_not_found', Response::HTTP_NOT_FOUND);

        return $notification;
    }

    private function getNotificationInstanceBy(string $mail): ?MailMessage
    {
        switch ($mail) {
            case 'fill':
                return FillNotification::sample();
            case 'recover-password':
                return RecoverPasswordNotification::sample();
            case 'answer':
                return AnswerNotification::sample();
            default:
                return null;
        }
    }
}