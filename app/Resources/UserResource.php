<?php

namespace App\Resources;

use App\Datas\User\UserUpdateData;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var UserUpdateData $this */
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            'email' => $this->getEmail(),
            'type' => $this->getType(),
            'token' => $this->getToken(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt()
        ];
    }
}