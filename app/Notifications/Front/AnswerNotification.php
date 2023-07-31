<?php

namespace App\Notifications\Front;

use App\Datas\Filler\FillerUpdateData;
use App\Datas\Form\FormUpdateData;
use App\Datas\FormUser\FormUserUpdateData;
use App\Datas\User\UserUpdateData;
use App\Filters\User\UserIdFilter;
use App\Http\Adapters\Filler\FillerUpdateRequestAdapter;
use App\Http\Adapters\Form\FormUpdateRequestAdapter;
use App\Notifications\BaseNotification;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
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
            'form' => $this->form,
            'file' => $this->file
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

    public static function sample(): MailMessage
    {
        $fillerRequest = new Request([
            'id' => 1,
            'name' => 'Preenchedor de exemplo',
            'email' => 'preenchedor@exemplo.com'
        ]);

        $filler = new FillerUpdateRequestAdapter($fillerRequest);

        $formRequest = new Request([
            'id' => 1,
            'name' => 'Formulário de exemplo',
            'slug' => 'fomulario-de-exemplo'
        ]);

        $form = new FormUpdateRequestAdapter($formRequest);

        $file = '/assets/pdf/example.pdf';

        $args = [
            'filler' => $filler,
            'form' => $form,
            'file' => $file
        ];

        $mail = new MailMessage();
        $mail->view('emails.front.answer', $args);

        return $mail;
    }
}