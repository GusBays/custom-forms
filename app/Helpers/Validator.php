<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class Validator
{
    private array $data;
    private array $rules;
    private ?int $id = null;
    private bool $isUpdate = false;

    public function __construct(
        Request $request
    )
    {
        $this->data = $request->all();
        $this->isUpdate = 'PUT' === $request->getMethod();
    }

    public static function make(Request $request): self
    {
        return new self($request);
    }

    public function rules(array $rules): self
    {
        $this->rules = $rules;

        return $this;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function validateOrFail(): void
    {
        if ($this->isUpdate) $this->addRulesToUpdateModels();

        $validation = FacadesValidator::make($this->data, $this->rules, [], ['id' => $this->id]);

        if ($validation->fails()) throw new ValidationException($validation, Response::HTTP_UNPROCESSABLE_ENTITY, $validation->getMessageBag());
    }

    private function addRulesToUpdateModels(): void
    {
        $toAddSometimes = fn (string $rules) => $rules . '|sometimes';
        $this->rules = collect($this->rules)->map($toAddSometimes)->all();
    }
}