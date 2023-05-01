<?php

namespace App\Resources;

use App\Datas\FormField\FormFieldUpdateData;
use Illuminate\Http\Resources\Json\JsonResource;

class FormFieldResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var FormFieldUpdateData $this */
        return [
            'id' => $this->getId(),
            'form_id' => $this->getFormId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'required' => $this->getRequired(),
            'type' => $this->getType(),
            'content' => $this->getContent(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt()
        ];
    }
}