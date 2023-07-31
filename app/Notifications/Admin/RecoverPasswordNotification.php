<?php

namespace App\Notifications\Admin;

use App\Datas\User\UserUpdateData;
use App\Http\Adapters\User\UserRequestUpdateAdapter;
use App\Notifications\BaseNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;

class RecoverPasswordNotification extends BaseNotification
{
    private UserUpdateData $user;
    private string $password;

    public function __construct(
        UserUpdateData $user,
        string $password
    )
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function toMail(): MailMessage
    {
        $mail = new MailMessage();
        $mail->subject($this->getSubject())
            ->replyTo($this->getReplyTo())
            ->from($this->getEmailFromAddress(), $this->getName())
            ->view('emails.admin.recover-password', $this->getArgs());

        return $mail;
    }

    public function getSubject(): string
    {
        return 'Aqui está sua nova senha!';
    }

    /** @return string[] */
    public function getReplyTo(): array
    {
        return [
            $this->user->getEmail(),
        ];
    }

    public function getArgs(): array
    {
        return [
            'user' => $this->user,
            'password' => $this->password
        ];
    }

    public static function sample(): MailMessage
    {
        $userRequest = new Request([
            'id' => 1,
            'name' => 'Usuário de exemplo',
        ]);

        $user = new UserRequestUpdateAdapter($userRequest);

        $password = 'nova-senha-exemplo-123';

        $args = [
            'user' => $user,
            'password' => $password
        ];

        $mail = new MailMessage();
        $mail->view('emails.admin.recover-password', $args);

        return $mail;
    }
}