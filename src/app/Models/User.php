<?php

namespace LaravelEnso\CorePlus\app\Models;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LaravelEnso\AvatarManager\app\Models\Avatar;
use LaravelEnso\CnpValidator\app\Classes\CnpValidator;
use LaravelEnso\Core\app\Classes\DefaultPreferences;
use LaravelEnso\Core\app\Enums\IsActiveEnum;
use LaravelEnso\Helpers\Traits\FormattedTimestamps;
use LaravelEnso\Helpers\Traits\IsActiveTrait;
use LaravelEnso\Impersonate\app\Traits\Model\Impersonate;

class User extends Authenticatable
{
    use Notifiable, Impersonate, IsActiveTrait, FormattedTimestamps;

    protected $fillable = [
        'email', 'first_name', 'last_name', 'phone', 'nin', 'is_active', 'role_id',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $appends = ['avatar_id', 'full_name', 'preferences'];

    public function owner()
    {
        return $this->belongsTo('LaravelEnso\Core\app\Models\Owner');
    }

    public function avatar()
    {
        return $this->hasOne('LaravelEnso\AvatarManager\app\Models\Avatar');
    }

    public function getAvatarIdAttribute()
    {
        $id = $this->avatar ? $this->avatar->id : null;
        unset($this->avatar);

        return $id;
    }

    public function role()
    {
        return $this->belongsTo('LaravelEnso\RoleManager\app\Models\Role');
    }

    public function logins()
    {
        return $this->hasMany('LaravelEnso\Core\app\Models\Login');
    }

    public function preference()
    {
        return $this->hasOne('LaravelEnso\Core\app\Models\Preference');
    }

    public function documents()
    {
        return $this->hasMany('LaravelEnso\DocumentsManager\app\Models\Document', 'created_by');
    }

    public function comments()
    {
        return $this->hasMany('LaravelEnso\CommentsManager\app\Models\Comment', 'created_by');
    }

    public function comment_tags()
    {
        return $this->belongsToMany('LaravelEnso\CommentsManager\app\Models\Comment');
    }

    public function getPreferencesAttribute()
    {
        $preferences = $this->preference ? $this->preference->value : (new DefaultPreferences())->getData();
        unset($this->preference);

        return $preferences;
    }

    public function action_logs()
    {
        return $this->hasMany('LaravelEnso\ActionLogger\app\Models\ActionLog');
    }

    public function isAdmin()
    {
        return $this->role_id == 1;
    }

    public function getFullNameAttribute()
    {
        return trim($this->first_name.' '.$this->last_name);
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

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($this, $token));
    }
}
