<?php

namespace App\Repositories;

use App\Models\Form;
use App\Models\FormUser;
use App\Models\User;

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

    public function createFirstFormUser(Form $form, User $user): FormUser
    {
        $this->model->form_id = $form->id;
        $this->model->user_id = $user->id;
        $this->model->type = 'creator';

        $this->model->save();

        return $this->model;
    }
}