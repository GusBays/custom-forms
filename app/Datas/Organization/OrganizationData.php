<?php

namespace App\Datas\Organization;

use App\Datas\User\UserData;
use Illuminate\Contracts\Support\Arrayable;

abstract class OrganizationData implements Arrayable
{
    public function __construct(
        private string $name,
        private ?int $formsCount = null,
        private ?int $usersCount = null,
        /** @var UserData[] */
        private ?array $users = []
    )
    {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getFormsCount(): ?int
    {
        return $this->formsCount;
    }

    public function getUsersCount(): ?int
    {
        return $this->usersCount;
    }

    /** 
     * @return UserData[]
     */
    public function getUsers(): ?array
    {
        return $this->users;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'users_count' => $this->getUsersCount(),
            'forms_count' => $this->getFormsCount(),
        ];
    }
}