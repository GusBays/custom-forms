<?php

namespace App\Interpreters\Form;

use App\Filters\Form\FormFilter;
use App\Interpreters\DbInterpreter;
use Illuminate\Database\Eloquent\Builder;

class FormSlugInterpreter extends DbInterpreter
{
    private FormFilter $filter;

    public function __construct(
        FormFilter $filter
    )
    {
        $this->filter = $filter;
    }
    
    public function interpret(): Builder
    {
        $slug = $this->filter->getSlug();

        if (blank($slug)) return $this->query;

        return $this->query->where('slug', $slug);
    }
}