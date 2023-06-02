<?php

namespace App\Filters\FormFieldAnswer;

use App\Contracts\Filter;

class FormFieldAnswerFilter implements Filter
{
    private ?int $id = null;
    private ?int $formId = null;
    private ?int $fillerId = null;
    private ?int $fieldId = null;

    public function __construct(
        int $id = null,
        int $formId = null,
        int $fillerId = null,
        int $fieldId = null
    )
    {
        $this->id = $id;
        $this->formId = $formId;
        $this->fillerId = $fillerId;
        $this->fieldId = $fieldId;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFormId(): ?int
    {
        return $this->formId;
    }

    public function getFillerId(): ?int
    {
        return $this->fillerId;
    }

    public function getFieldId(): ?int
    {
        return $this->fieldId;
    }
}