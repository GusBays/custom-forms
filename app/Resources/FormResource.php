<?php

namespace App\Resources;

use App\Datas\Form\FormUpdateData;
use Illuminate\Http\Resources\Json\JsonResource;

class FormResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var FormUpdateData $this */
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'slug' => $this->getSlug(),
            'available_until' => $this->getAvailableUntil(),
            'fill_limit' => $this->getFillLimit(),
            'should_notify_each_fill' => $this->getShouldNotifyEachFill(),
            'active' => $this->getActive(),
            'form_users' => FormUserResource::collection($this->getFormUsers()),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}