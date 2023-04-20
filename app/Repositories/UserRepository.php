<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Firebase\JWT\JWT;

class UserRepository extends BaseRepository
{
    /** @var User */
    protected $model;

    public function __construct(
        User $model
    )
    {
        parent::__construct($model);
    }

    public function getByEmail(string $email): ?User
    {
        return $this->getOneByOrFail('email', $email);
    }

    public function createJwtToken(User $user): string
    {
        return (new JWT)->encode([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
        ], 
        env('APP_KEY'),
        'HS256');
    }
}