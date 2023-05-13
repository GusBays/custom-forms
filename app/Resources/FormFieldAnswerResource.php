<?php

namespace App\Resources;

use App\Datas\FormFieldAnswer\FormFieldAnswerUpdateData;
use Illuminate\Http\Resources\Json\JsonResource;

class FormFieldAnswerResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var FormFieldAnswerUpdateData $this */
        return [
            'id' => $this->getId(),
            'form_id' => $this->getFormId(),
            'field_id' => $this->getFieldId(),
            'filler_id' => $this->getFillerId(),
            'answer' => $this->getAnswer(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt()
        ];
    }
}