<?php

namespace App\Http\Controllers;

use App\Http\Adapters\MailPreview\MailPreviewRequestAdapter;
use App\Services\MailPreviewService;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;

class MailPreviewController
{
    private MailPreviewService $service;

    public function __construct(
        MailPreviewService $service
    )
    {
        $this->service = $service;
    }

    public function getMailPreview(Request $request): MailMessage
    {
        return $this->service->getMailPreview(new MailPreviewRequestAdapter($request));
    }
}