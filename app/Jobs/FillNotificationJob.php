<?php

namespace App\Jobs;

use App\Datas\Form\FormUpdateData;
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
    private UserRepository $userRepository;

    public function __construct(
        FormUpdateData $form
    )
    {
        $this->form = $form;
        $this->userRepository = app(UserRepository::class);
    }

    public function handle(): void
    {
        config(['organization_id' => $this->form->getOrganizationId()]);

        $toGetNotifiable = fn (FormUserUpdateData $user) => $this->userRepository->getNotifiableInstance(new UserIdFilter($user->getUserId()));
        $notify = fn (User $user) => $user->notify(new FillNotification($this->form));
        collect($this->form->getFormUsers())
            ->map($toGetNotifiable)
            ->each($notify);
    }
}
