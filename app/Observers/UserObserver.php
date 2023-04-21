<?php

namespace App\Observers;

use App\Models\User;
use App\Repositories\UserRepository;

class UserObserver
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    public function saving(User $user): void
    {
        if ($user->exists || !$user->wasChanged(['first_name', 'last_name', 'email'])) return;

        $user->token = $this->userRepository->createJwtToken($user);
    }
}