<?php

namespace App\Resources;

use App\Datas\Organization\OrganizationUpdateData;
use App\Datas\User\UserUpdateData;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var OrganizationUpdateData $this */

        $toArray = fn (UserUpdateData $user) => $user->toArray();
        $users = collect($this->getUsers())->map($toArray)->all();

        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'users' => $users,
            'forms_count' => $this->getFormsCount(),
            'users_count' => $this->getUsersCount(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}