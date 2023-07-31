<?php

namespace App\Http\Adapters\MailPreview;

use App\Datas\Notification\MailPreviewData;
use Illuminate\Http\Request;

class MailPreviewRequestAdapter extends MailPreviewData
{
    public function __construct(
        Request $request
    )
    {
        parent::__construct(
            $request->route('notification')
        );
    }
}