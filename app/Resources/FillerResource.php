<?php

namespace App\Resources;

use App\Datas\Filler\FillerUpdateData;
use Illuminate\Http\Resources\Json\JsonResource;

class FillerResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var FillerUpdateData $this */
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'first_name' => $this->getFirstName(),
            'last_name' => $this->getLastName(),
            'email' => $this->getEmail(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt()
        ];
    }
}