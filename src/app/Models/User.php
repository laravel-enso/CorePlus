<?php

namespace LaravelEnso\CorePlus\app\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LaravelEnso\CnpValidator\app\Classes\CnpValidator;
use LaravelEnso\Core\app\Enums\IsActiveEnum;
use LaravelEnso\Core\app\Http\Controllers\Core\PreferencesController;
use LaravelEnso\Core\app\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'email', 'first_name', 'last_name', 'phone', 'nin', 'is_active', 'role_id',
    ];

    protected $hidden = [
        'password', 'remember_token', 'api_token', 'slack',
    ];

    protected $appends = ['avatar_link', 'full_name'];

    public function owner()
    {
        return $this->belongsTo('LaravelEnso\Core\app\Models\Owner');
    }

    public function avatar()
    {
        return $this->hasOne('LaravelEnso\Core\app\Models\Avatar');
    }

    public function role()
    {
        return $this->belongsTo('LaravelEnso\Core\app\Models\Role');
    }

    public function logins()
    {
        return $this->hasMany('LaravelEnso\Core\app\Models\Login');
    }

    public function preferences()
    {
        return $this->hasMany('LaravelEnso\Core\app\Models\Preference');
    }

    public function comments()
    {
        return $this->hasMany('LaravelEnso\CommentsManager\app\Models\Comment');
    }

    public function comment_tags()
    {
        return $this->belongsToMany('LaravelEnso\CommentsManager\app\Models\Comment');
    }

    public function getAvatarLinkAttribute()
    {
        return $this->avatar ? '/core/avatars/'.$this->avatar->saved_name : asset('/images/profile.png');
    }

    public function getLanguageAttribute()
    {
        return json_decode($this->global_preferences)->lang;
    }

    public function getGlobalPreferencesAttribute()
    {
        return PreferencesController::getPreferences('global');
    }

    public function getPreferences($page)
    {
        return PreferencesController::getPreferences($page);
    }

    public function action_histories()
    {
        return $this->hasMany('LaravelEnso\ActionLogger\app\Models\ActionHistory');
    }

    public function isAdmin()
    {
        return $this->role_id == 1;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function hasAccessTo($route)
    {
        return $this->role->permissions->pluck('name')->search($route) !== false;
    }

    public function setImpersonating($id)
    {
        session()->put('impersonate', $id);
    }

    public function stopImpersonating()
    {
        session()->forget('impersonate');
    }

    public function isImpersonating()
    {
        return session()->has('impersonate');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getCreatedDateAttribute()
    {
        return \Date::parse($this->created_at)->format('d-m-Y');
    }

    public function getBirthdayAttribute()
    {
        $birthday = 'N/A';

        if (!(new CnpValidator($this->nin))->isValid()) {
            return $birthday;
        }

        $type = substr($this->nin, 0, 1);
        $year = substr($this->nin, 1, 2);
        $month = substr($this->nin, 3, 2);
        $day = substr($this->nin, 5, 2);
        $year = ($type === '5' || $type === '6') ? '20'.$year : '19'.$year;

        $birthday = \Date::parse($year.$month.$day)->format('d-m-Y');

        if ($birthday == \Date::now()->format('d-m-Y')) {
            $birthday = __('Happy Birthday');
        }

        return $birthday;
    }

    public function getActiveLabelAttribute()
    {
        $isActiveEnum = new IsActiveEnum();

        return $isActiveEnum->getValueByKey($this->is_active);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($this, $token));
    }

    public function routeNotificationForSlack()
    {
        return $this->slack;
    }
}
