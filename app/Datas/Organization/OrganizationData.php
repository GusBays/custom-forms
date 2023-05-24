<?php

namespace App\Datas\Organization;

use App\Datas\User\UserData;
use Illuminate\Contracts\Support\Arrayable;

abstract class OrganizationData implements Arrayable
{
    private string $name;
    private ?int $forms_count = null;
    private ?int $users_count = null;
    /** @var UserData[] */
    private ?array $users = null;

    public function __construct(
        string $name,
        int $forms_count = null,
        int $users_count = null,
        array $users = []
    )
    {
        $this->name = $name;
        $this->forms_count = $forms_count;
        $this->users_count = $users_count;
        $this->users = $users;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getFormsCount(): ?int
    {
        return $this->forms_count;
    }

    public function getUsersCount(): ?int
    {
        return $this->users_count;
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