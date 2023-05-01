<?php

namespace App\Resources;

use App\Datas\Form\FormUpdateData;
use Illuminate\Http\Resources\Json\JsonResource;

class FormResource extends JsonResource
{
    // @TODO: trazer junto a collection de form users
    public function toArray($request)
    {
        /** @var FormUpdateData $this */
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'available_until' => $this->getAvailableUntil(),
            'fill_limit' => $this->getFillLimit(),
            'should_notify_each_fill' => $this->getShouldNotifyEachFill(),
            'active' => $this->getActive(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}