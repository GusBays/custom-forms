<?php

namespace App\Jobs;

use App\Datas\Form\FormUpdateData;
use App\Datas\FormUser\FormUserUpdateData;
use App\Filters\User\UserIdFilter;
use App\Models\User;
use App\Notifications\Admin\AdminNotification;
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

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(
        FormUpdateData $form
    )
    {
        $this->form = $form;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $toGetNotifiable = fn (FormUserUpdateData $user) => $this->userRepository->getNotifiableInstance(new UserIdFilter($user->getId()));
        $notify = fn (User $user) => $user->notify('mail');
        collect($this->form->getFormUsers())
            ->map($toGetNotifiable)
            ->each($notify);
    }
}
