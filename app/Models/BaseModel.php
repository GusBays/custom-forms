<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected array $rules;

    public function getRules(): array
    {
        return $this->rules;
    }
}