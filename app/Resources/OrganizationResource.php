<?php

namespace App\Resources;

use App\Datas\Organization\OrganizationUpdateData;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var OrganizationUpdateData $this */
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'forms_count' => $this->getFormsCount(),
            'users_count' => $this->getUsersCount(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}