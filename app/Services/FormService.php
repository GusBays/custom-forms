<?php

namespace App\Services;

use App\Helpers\Validator;
use App\Repositories\FormRepository;
use App\Repositories\FormUserRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FormService extends BaseService
{
    /** @var FormRepository */
    protected $repository;

    protected UserRepository $userRepository;
    protected FormUserRepository $formUserRepository;

    public function __construct(
        FormRepository $repository,
        UserRepository $userRepository,
        FormUserRepository $formUserRepository
    )
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
        $this->formUserRepository = $formUserRepository;
    }

    public function create(Request $request): Model
    {
        Validator::make($request)
            ->rules($this->repository->getModelRules())
            ->validateOrFail();

        $user = $this->userRepository->getOne(config('user_id'));
        
        $form = $this->repository->create($request->all());

        $this->formUserRepository->createFirstFormUser($form, $user);
        
        return $form;
    }
}