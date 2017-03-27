<?php

namespace LaravelEnso\CorePlus\app\Models;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = [
        'name', 'fiscal_code', 'reg_com_nr', 'city', 'county', 'bank', 'bank_account', 'postal_code', 'contact', 'phone', 'email', 'address', 'is_individual', 'is_active',
    ];

    public function users()
    {
        return $this->hasMany('LaravelEnso\Core\app\Models\User');
    }

    public function roles()
    {
        return $this->belongsToMany('LaravelEnso\Core\app\Models\Role');
    }

    public function getRolesListAttribute()
    {
        return $this->roles->pluck('id')->toArray();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeIndividual($query)
    {
        return $query->where('is_individual', 1);
    }
}
