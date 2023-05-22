<?php

namespace App\Datas\FormFieldAnswer;

use App\Datas\Filler\FillerData;
use Illuminate\Contracts\Support\Arrayable;

abstract class FormFieldAnswerData implements Arrayable
{
    private int $form_id;
    private int $field_id;
    private ?int $filler_id = null;
    private ?array $answer = null;
    private ?FillerData $filler = null;

    public function __construct(
        int $form_id,
        int $field_id,
        int $filler_id = null,
        array $answer = null,
        FillerData $filler = null
    )
    {
        $this->form_id = $form_id;
        $this->field_id = $field_id;
        $this->filler_id = $filler_id;
        $this->answer = $answer;
        $this->filler = $filler;
    }

    public function getFormId(): int
    {
        return $this->form_id;
    }

    public function getFieldId(): int
    {
        return $this->field_id;
    }

    public function getFillerId(): ?int
    {
        return $this->filler_id;
    }

    public function getAnswer(): ?array
    {
        return $this->answer;
    }

    public function getFiller(): FillerData
    {
        return $this->filler;
    }

    public function setFillerId(int $fillerId): self
    {
        $this->filler_id = $fillerId;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'form_id' => $this->getFormId(),
            'field_id' => $this->getFieldId(),
            'filler_id' => $this->getFillerId(),
            'answer' => $this->getAnswer(),
        ];
    }
}