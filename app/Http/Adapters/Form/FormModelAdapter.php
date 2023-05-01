<?php

namespace App\Http\Adapters\Form;

use App\Datas\Form\FormUpdateData;
use App\Http\Adapters\FormUser\FormUserModelAdapter;
use App\Models\Form;

class FormModelAdapter extends FormUpdateData
{
    public function __construct(
        Form $form
    )
    {
        parent::__construct(
            $form->id,
            $form->getAttribute('organization_id') ?? $form->getAttribute('forms.organization_id'),
            $form->name,
            $form->available_until,
            $form->fill_limit,
            $form->should_notify_each_fill,
            $form->active,
            $form->slug,
            FormUserModelAdapter::createFromFormModel($form->formUsers),
            $form->created_at,
            $form->updated_at
        );
    }

    public static function collection(array $forms): array
    {
        return collect($forms)->mapInto(self::class)->all();
    }
}