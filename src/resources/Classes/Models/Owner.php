<?php

namespace App;

use LaravelEnso\CorePlus\app\Models\Owner as Owners;

class Owner extends Owners
{
    protected $fillable = [
        'name', 'fiscal_code', 'reg_com_nr', 'city', 'county', 'bank', 'bank_account', 'postal_code', 'contact', 'phone', 'email', 'address', 'is_individual', 'is_active',
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function comments()
    {
        return $this->morphMany('LaravelEnso\CommentsManager\app\Models\Comment', 'commentable');
    }

    public function documents()
    {
        return $this->morphMany('LaravelEnso\DocumentsManager\app\Models\Document', 'documentable');
    }
}
