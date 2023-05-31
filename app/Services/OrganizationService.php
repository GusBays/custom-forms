<?php

namespace App\Services;

use App\Datas\Organization\OrganizationData;
use App\Datas\Organization\OrganizationUpdateData;
use App\Filters\Organization\OrganizationFilter;
use App\Filters\Organization\OrganizationIdFilter;
use App\Repositories\OrganizationRepository;
use App\Repositories\UserRepository;

class OrganizationService
{
    protected OrganizationRepository $repository;

    protected UserRepository $userRepository;

    public function __construct(
        OrganizationRepository $repository,
        UserRepository $userRepository
    )
    {
        $this->repository = $repository;
        $this->userRepository = $userRepository;
    }

    public function create(OrganizationData $data): OrganizationUpdateData
    {
        $organization = $this->repository->create($data);
        
        config(['organization_id' => $organization->getId()]);

        $this->userRepository->createFirstUser(collect($data->getUsers())->first());

        return $this->repository->getOne(new OrganizationIdFilter());
    }

    public function getOne(OrganizationFilter $filter): OrganizationUpdateData
    {
        return $this->repository->getOne($filter);
    }
}