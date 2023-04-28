<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;

class User extends BaseModel
{
    use Notifiable;
    use Authenticatable;
    use Authorizable;

    protected array $rules = [
        'first_name' => 'required|max:255',
        'last_name' => 'nullable|max:255',
        'email' => 'required|unique:users',
        'password' => 'required|min:6|max:255',
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'token',
    ];

    protected array $filters = [
        'id',
        'first_name',
        'last_name',
        'email'
    ];

    protected array $sorts = [
        'id'
    ];

    protected array $search = [
        'first_name'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function (User $model) {
            $name = $model->first_name;

            if (filled($model->last_name)) $name = $name . ' ' . $model->last_name;

            $model->setAttribute('name', $name);
        });
    }

    public function setPasswordAttribute($value): void
    {
        if (blank($value)) return;

        $this->attributes['password'] = app('hash')->make($value);
    }
}
