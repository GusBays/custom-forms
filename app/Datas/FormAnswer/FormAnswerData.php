<?php

namespace App\Datas\FormAnswer;

use Illuminate\Contracts\Support\Arrayable;

abstract class FormAnswerData implements Arrayable
{
    private int $formId;
    private ?int $fillerId = null;
    private ?array $answers = null;

    public function __construct(
        int $formId,
        int $fillerId = null,
        array $answers = null
    )
    {
        $this->formId = $formId;
        $this->fillerId = $fillerId;
        $this->answers = $answers;
    }

    public function getFormId(): int
    {
        return $this->formId;
    }

    public function getFillerId(): ?int
    {
        return $this->fillerId;
    }

    public function setFillerId(int $fillerId): self
    {
        $this->fillerId = $fillerId;

        return $this;
    }

    public function getAnswers(): ?array
    {
        return $this->answers;
    }

    public function toArray(): array
    {
        return [
            'form_id' => $this->getFormId(),
            'filler_id' => $this->getFillerId(),
            'answers' => $this->getAnswers(),
        ];
    }
}