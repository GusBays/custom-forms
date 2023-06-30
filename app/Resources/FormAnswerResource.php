<?php

namespace App\Resources;

use App\Datas\FormAnswer\FormAnswerUpdateData;
use Illuminate\Http\Resources\Json\JsonResource;

class FormAnswerResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var FormAnswerUpdateData $this */
        return [
            'id' => $this->getId(),
            'form_id' => $this->getFormId(),
            'filler_id' => $this->getFillerId(),
            'answers' => $this->getAnswers(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt()
        ];
    }
}