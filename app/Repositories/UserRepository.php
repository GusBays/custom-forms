<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Response;

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

    public function getByEmail(string $email): User
    {
        return $this->getOneByOrFail('email', $email);
    }

    public function getByToken(string $token = null): User
    {
        return $this->getOneByOrFail('token', $token);
    }

    public function createFirstUser(array $data): User
    {
        $query = $this->model->newQueryWithoutScopes();

        if ($query->where('organization_id', config('organization_id'))->exists()) throw new \Throwable('organization_already_have_user', Response::HTTP_INTERNAL_SERVER_ERROR);
        
        $this->model->type = 'owner';
        $this->model->fill($data)->save();

        return $this->model;
    }

    public function createJwtToken(User $user): string
    {
        return (new JWT)->encode([
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'organization_id' => $user->organization_id
        ], 
        env('APP_KEY'),
        'HS256');
    }
}