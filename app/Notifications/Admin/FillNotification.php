<?php

namespace App\Notifications\Admin;

use App\Datas\Filler\FillerUpdateData;
use App\Datas\Form\FormUpdateData;
use App\Datas\FormUser\FormUserUpdateData;
use App\Datas\User\UserUpdateData;
use App\Filters\User\UserIdFilter;
use App\Notifications\BaseNotification;
use App\Repositories\UserRepository;
use Illuminate\Notifications\Messages\MailMessage;

class FillNotification extends BaseNotification
{
    private FormUpdateData $form;

    public function __construct(
        FormUpdateData $form
    )
    {
        $this->form = $form;
    }

    public function toMail(): MailMessage
    {
        $mail = new MailMessage();
        $mail->subject($this->getSubject())
            ->replyTo($this->getReplyTo())
            ->from($this->getEmailFromAddress(), $this->getName())
            ->view('emails.admin.fill', $this->getArgs());

        return $mail;
    }

    public function getSubject(): string
    {
        return 'Nova resposta registrada em um formulário, venha conferir!';
    }

    /** @return string[] */
    public function getReplyTo(): array
    {
        $userRepository = $this->getUserRepository();
        $toId = fn (FormUserUpdateData $formUser) => $formUser->getUserId();
        $toGetUser = fn (int $id) => $userRepository->getOne(new UserIdFilter($id));
        $toMailAddress = fn (UserUpdateData $user) => $user->getEmail();
        return collect($this->form->getFormUsers())
            ->map($toId)
            ->map($toGetUser)
            ->map($toMailAddress)
            ->all();
    }

    public function getArgs(): array
    {
        return [
            'form' => $this->form
        ];
    }

    private function getUserRepository(): UserRepository
    {
        return app(UserRepository::class);
    }
}