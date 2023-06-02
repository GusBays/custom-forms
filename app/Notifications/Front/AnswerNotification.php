<?php

namespace App\Notifications\Front;

use App\Datas\Filler\FillerUpdateData;
use App\Datas\Form\FormUpdateData;
use App\Datas\FormUser\FormUserUpdateData;
use App\Datas\User\UserUpdateData;
use App\Filters\User\UserIdFilter;
use App\Notifications\BaseNotification;
use App\Repositories\UserRepository;
use Illuminate\Notifications\Messages\MailMessage;

class AnswerNotification extends BaseNotification
{
    private FillerUpdateData $filler;
    private FormUpdateData $form;
    private string $file;

    public function __construct(
        FillerUpdateData $filler,
        FormUpdateData $form,
        string $file
    )
    {
        $this->filler = $filler;
        $this->form = $form;
        $this->file = $file;
    }

    public function toMail(): MailMessage
    {
        $mail = new MailMessage();
        $mail->subject($this->getSubject())
            ->replyTo($this->getReplyTo())
            ->from($this->getEmailFromAddress(), $this->getName())
            ->attach($this->getFile())
            ->view('emails.front.answer', $this->getArgs());
        
        return $mail;
    }

    public function getSubject(): string
    {
        return 'Aqui está uma cópia do seu formulário!';
    }

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
            ->all();;
    }

    public function getArgs(): array
    {
        return [
            'filler' => $this->filler,
            'form' => $this->form
        ];
    }

    public function getFile(): string
    {
        return $this->file;
    }

    private function getUserRepository(): UserRepository
    {
        return app(UserRepository::class);
    }
}