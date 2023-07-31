<?php

namespace App\Jobs;

use App\Datas\Filler\FillerUpdateData;
use App\Datas\Form\FormUpdateData;
use App\Datas\FormAnswer\FormAnswerUpdateData;
use App\Datas\FormUser\FormUserUpdateData;
use App\Filters\User\UserIdFilter;
use App\Models\User;
use App\Notifications\Admin\FillNotification;
use App\Repositories\UserRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FillNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private FormUpdateData $form;
    private FillerUpdateData $filler;
    private FormAnswerUpdateData $answer;
    private UserRepository $userRepository;

    public function __construct(
        FormUpdateData $form,
        FillerUpdateData $filler,
        FormAnswerUpdateData $answer
    )
    {
        $this->form = $form;
        $this->filler = $filler;
        $this->answer = $answer;
        $this->userRepository = app(UserRepository::class);
    }

    public function handle(): void
    {
        config(['organization_id' => $this->form->getOrganizationId()]);

        $toGetNotifiable = fn (FormUserUpdateData $user) => $this->userRepository->getNotifiableInstance(new UserIdFilter($user->getUserId()));
        $notify = fn (User $user) => $user->notify(new FillNotification($this->form, $this->filler, $this->answer));
        collect($this->form->getFormUsers())
            ->map($toGetNotifiable)
            ->each($notify);
    }
}
