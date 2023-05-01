<?php

namespace App\Repositories;

use App\Datas\Form\FormUpdateData;
use App\Models\FormUser;

class FormUserRepository extends BaseRepository
{
    /** @var FormUser */
    protected $model;

    public function __construct(
        FormUser $model
    )
    {
        parent::__construct($model);
    }

    public function createFirstFormUser(FormUpdateData $form): FormUser
    {
        $this->model->form_id = $form->getId();
        $this->model->user_id = config('user_id');
        $this->model->type = 'creator';

        $this->model->save();

        return $this->model;
    }
}