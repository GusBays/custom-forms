<?php

namespace App\Resources;

use App\Datas\FormUser\FormUserUpdateData;
use Illuminate\Http\Resources\Json\JsonResource;

class FormUserResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var FormUserUpdateData $this */
        return [
            'id' => $this->getId(),
            'form_id' => $this->getFormId(),
            'user_id' => $this->getUserId(),
            'type' => $this->getType(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}