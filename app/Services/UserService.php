<?php

namespace App\Services;

use App\Contracts\CookieEnum;
use App\Helpers\Validator;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserService extends BaseService
{
    /** @var UserRepository */
    protected $repository;

    public function __construct(
        UserRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function create(Request $request): Model
    {
        $resource = parent::create($request);
    
        addCookie(CookieEnum::ADM_TOKEN, $resource->token);

        return $resource;
    }

    public function login(Request $request): Model
    {
        Validator::make($request)
            ->rules([
                'email' => 'required',
                'password' => 'required',
            ])
            ->validateOrFail();

        $user = $this->repository->getByEmail($request->email);

        if (!$this->check($request->password, $user->password)) throw new Exception('invalid_password', Response::HTTP_UNAUTHORIZED);
        
        addCookie(CookieEnum::ADM_TOKEN, $user->token);

        return $user;
    }

    private function check(string $requestPassword, string $userPassword): bool
    {
        return Hash::check($requestPassword, $userPassword);
    }
}