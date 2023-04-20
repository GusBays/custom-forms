<?php

namespace App\Services;

use App\Contracts\CookieEnum;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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
}