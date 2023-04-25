<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected array $rules;

    protected array $filters;

    protected array $sorts;

    /** @var int */
    protected $perPage = 25;

    public function getRules(): array
    {
        return $this->rules;
    }

    public function getFilters(): array
    {
        return $this->filters;
    }

    public function getSorts(): array
    {
        return $this->sorts;
    }
}