<?php

namespace App\Helpers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class Validator
{
    private array $data;
    private array $rules;

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

    public function validateOrFail(): void
    {
        $validation = FacadesValidator::make($this->data, $this->rules);

        if ($validation->fails()) {
            $errors = $validation->getMessageBag()->all();
            $toAddEndOfLine = fn (string $error) => $error . PHP_EOL;
            $formattedErrors = collect($errors)->map($toAddEndOfLine)->all();
            $errorsString = implode($formattedErrors);
            
            throw new Exception('model_validation_error: [ ' . PHP_EOL . $errorsString . ']');
        }
    }
}