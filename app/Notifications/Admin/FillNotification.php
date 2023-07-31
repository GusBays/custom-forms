<?php

namespace App\Notifications\Admin;

use App\Datas\Filler\FillerUpdateData;
use App\Datas\Form\FormUpdateData;
use App\Datas\FormAnswer\FormAnswerUpdateData;
use App\Datas\FormUser\FormUserUpdateData;
use App\Datas\User\UserUpdateData;
use App\Filters\User\UserIdFilter;
use App\Http\Adapters\Filler\FillerUpdateRequestAdapter;
use App\Http\Adapters\Form\FormUpdateRequestAdapter;
use App\Http\Adapters\FormAnswer\FormAnswerUpdateRequestAdapter;
use App\Notifications\BaseNotification;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;

class FillNotification extends BaseNotification
{
    private FormUpdateData $form;
    private FillerUpdateData $filler;
    private FormAnswerUpdateData $answer;

    public function __construct(
        FormUpdateData $form,
        FillerUpdateData $filler,
        FormAnswerUpdateData $answer
    )
    {
        $this->form = $form;
        $this->filler = $filler;
        $this->answer = $answer;
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
            'form' => $this->form,
            'filler' => $this->filler,
            'answer' => $this->answer
        ];
    }

    private function getUserRepository(): UserRepository
    {
        return app(UserRepository::class);
    }

    public static function sample(): MailMessage
    {
        $formRequest = new Request([
            'id' => 1,
            'name' => 'Formulário de exemplo'
        ]);

        $form = new FormUpdateRequestAdapter($formRequest);

        $fillerRequest = new Request([
            'id' => 1,
            'name' => 'Preenchedor de exemplo'
        ]);

        $filler = new FillerUpdateRequestAdapter($fillerRequest);

        $answerRequest = new Request([
            'id' => 1
        ]);

        $answer = new FormAnswerUpdateRequestAdapter($answerRequest);

        $args = [
            'form' => $form,
            'filler' => $filler,
            'answer' => $answer
        ];

        $mail = new MailMessage();
        $mail->view('emails.admin.fill', $args);

        return $mail;
    }
}