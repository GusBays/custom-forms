<?php

namespace App\Jobs;

use App\Datas\User\UserUpdateData;
use App\Filters\User\UserIdFilter;
use App\Notifications\Admin\RecoverPasswordNotification;
use App\Repositories\UserRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RecoverPasswordJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private UserUpdateData $user;
    private string $password;
    private UserRepository $userRepository;

    public function __construct(
        UserUpdateData $user,
        string $password
    )
    {
        $this->user = $user;
        $this->password = $password;
        $this->userRepository = app(UserRepository::class);
    }

    public function handle(): void
    {
        config(['organization_id' => $this->user->getOrganizationId()]);
    
        $userModel = $this->userRepository->getNotifiableInstance(new UserIdFilter($this->user->getId()));

        $userModel->notify(new RecoverPasswordNotification($this->user, $this->password));
    }
}
