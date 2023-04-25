<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected array $rules;

    protected array $filters = [];

    protected array $sorts = [];

    protected array $search = [];

    /** @var int */
    protected $perPage = 25;

    protected int $minPerPage = 15;
    protected int $maxPerPage = 150;

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

    public function getSearch(): array
    {
        return $this->search;
    }

    public function getMinPerPage(): int
    {
        return $this->minPerPage;
    }

    public function getMaxPerPage(): int
    {
        return $this->maxPerPage;
    }
}