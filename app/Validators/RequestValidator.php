<?php

namespace App\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class RequestValidator
{
    private array $rules;
    private ?int $id = null;
    private array $data;
    protected bool $isUpdate = false;
    
    public function __construct(
        Request $request
    )
    {
        $this->isUpdate = 'PUT' === $request->getMethod();
        $this->data = $request->all();
        $this->rules = $this->getRules();
    }

    public function validate(): void
    {
        if ($this->isUpdate) $this->addRulesToUpdateModels();

        Validator::make($this->data, $this->rules, [], ['id' => $this->id])->validate();
    }

    abstract public function getRules(): array;

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    private function addRulesToUpdateModels(): void
    {
        $toAddSometimes = fn (string $rules) => $rules . '|sometimes';
        $this->rules = collect($this->rules)->map($toAddSometimes)->all();
    }
}