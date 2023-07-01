<?php

namespace App\Filters\FormAnswer;

class FormAnswerFillerIdFilter extends FormAnswerFilter
{
    public function __construct(
        int $fillerId
    )
    {
        parent::__construct(
            null,
            null,
            $fillerId,
            null
        );
    }
}