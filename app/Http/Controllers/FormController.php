<?php

namespace App\Http\Controllers;

use App\Services\FormService;

class FormController extends BaseController
{
    /** @var FormService */
    protected $service;

    public function __construct(
        FormService $service
    )
    {
        $this->service = $service;
    }
}