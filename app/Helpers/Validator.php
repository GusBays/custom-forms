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

    public function __construct(
        Request $request)
    {
        $this->data = $request->all();
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
        $validation = FacadesValidator::make($this->data, $this->rules, [], ['id' => $this->id]);

        if ($validation->fails()) {
            throw new ValidationException($validation, Response::HTTP_UNPROCESSABLE_ENTITY, $validation->getMessageBag());
        }
    }
}