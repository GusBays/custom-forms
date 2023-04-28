<?php

namespace App\Services;

use App\Helpers\Validator;
use App\Models\Organization;
use App\Repositories\OrganizationRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OrganizationService extends BaseService
{
    /** @var OrganizationRepository */
    protected $repository;

    protected UserRepository $userRepository;

    public function __construct(
        OrganizationRepository $repository,
        UserRepository $userRepository
    )
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function create(Request $request): Organization
    {
        Validator::make($request)
            ->rules($this->repository->getModelRules())
            ->validateOrFail();

        $organizationRequest = $request->only(['name']);
        
        $organization = $this->repository->create($organizationRequest);
        
        config(['organization_id' => $organization->id]);

        $this->userRepository->createFirstUser($request->all());

        return $organization;
    }
}