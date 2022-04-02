<?php

namespace App\Models;

use App\Core\Traits\SpatieLogsActivity;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    use SpatieLogsActivity;
    use HasRoles;
    use CausesActivity;

    protected $table = "user";

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['firstname', 'lastname', 'email', 'api_token', 'password', 'department_id', 'mobile', 'photo', 'user_type', 'remember_token', 'status', 'otp', 'user_token', 'token_date', 'push_notifications'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'push_notifications' => 'bool',
        'token_date' => 'datetime'
    ];

    protected $avaliableRoles = [
        'Admin'   => '5',
        'Officer' => '1',
        'Receptionist' => '2',
        'Client'  => '3',
    ];

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get a fullname combination of firstname and lastname
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    /**
     * Prepare proper error handling for url attribute
     *
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->info) {
            return asset($this->info->avatar_url);
        }

        return asset(theme()->getMediaUrlPath() . 'avatars/blank.png');
    }

    /**
     * User relation to info model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function info()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function getRefreshToken()
    {
        $current = Carbon::now();
        if ($this->token_date == null)
            return 0;

        if ($this->token_date->addDays(30) < $current)
            return 1;
        else
            return 0;
    }


    // public function hasRole($role)
    // {  
    //     return ($this->user_type == $this->avaliableRoles[ucfirst($role)]);
    // } 

    // public function role()
    // {  
    //     $roles = array_flip($this->avaliableRoles);
    //     return $roles[$this->user_type];
    // } 

    // public function roles($user_type = null)
    // {   
    //     $roles = array_flip($this->avaliableRoles);
    //     $list = $roles;
    //     unset($list['5']); 

    //     return (!empty($user_type)?($roles[$user_type]):$list);
    // } 

    public function accounts()
    {
        return $this->hasMany('App\Models\UserSocialAccount');
    }

    public function department()
    {
        return $this->hasOne('App\Models\Department', 'id', 'department_id');
    }

    public function userinfo()
    {
        return $this->hasOne('App\Models\UserInfo', 'user_id', 'id');
    }

    public function usersocial()
    {
        return $this->hasOne('App\Models\UserSocialAccount', 'user_id', 'id');
    }
}
