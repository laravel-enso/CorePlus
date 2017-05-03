<?php

namespace App;

use LaravelEnso\CorePlus\app\Models\User as Users;

class User extends Users
{
    protected $fillable = [
        'first_name', 'last_name', 'phone', 'nin', 'is_active', 'role_id'
    ];

    protected $hidden = [
        'password', 'remember_token', 'api_token', 'slack'
    ];

    protected $appends = ['avatar_link', 'full_name'];

    public function owner()
    {
        return $this->belongsTo('App\Owner');
    }
}
