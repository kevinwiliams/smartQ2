<?php

namespace App\Models;

use App\Core\Traits\SpatieLogsActivity;
use App\Http\Controllers\Common\Utilities_lib;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    use SpatieLogsActivity;
    use HasRoles;
    use CausesActivity;
    use SoftDeletes;

    protected $table = "user";

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['firstname', 'lastname', 'email', 'api_token', 'password', 'department_id', 'location_id', 'mobile', 'photo', 'user_type', 'remember_token', 'status', 'otp', 'otp_type', 'otp_timestamp', 'otp_confirmation_timestamp', 'user_token', 'token_date', 'push_notifications'];

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
    protected $appends = ['name', 'avatar_url'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'push_notifications' => 'bool',
        'token_date' => 'datetime',
        'otp_timestamp' => 'datetime'
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
            return 1;

        if ($this->token_date->addDays(30) < $current)
            return 1;
        else
            return 0;
    }

    public function getCurrentOTP()
    {
        $current = Carbon::now();
        if ($this->otp_timestamp == null)
            return '';

        if ($this->otp_timestamp->addDays(60) > $current)
            return $this->otp;
        else
            return '';
    }

    public function getIsOTPValidAttribute()
    {
        $current = Carbon::now();

        if ($this->otp_timestamp == null)
            return false;

        if ($this->otp_confirmation_timestamp == null)
            return false;

        if ($this->otp_timestamp->addDays(60) > $current && $this->otp_confirmation_timestamp > $this->otp_timestamp)
            return true;
        else
            return false;
    }

    public function vipLocations()
    {
        return $this->belongsToMany(Location::class, 'vip_list', 'client_id', 'location_id');
    }

    public function isVipAtLocation(int $locationId)
    {
        return $this->vipLocations()->where('location_id', $locationId)->whereNull('deleted_at')->exists();
    }

    public function blockedLocations()
    {
        return $this->belongsToMany(Location::class, 'blacklists', 'client_id', 'location_id');
    }

    public function isBlockedAtLocation(int $locationId)
    {
        return $this->blockedLocations()->where('location_id', $locationId)->where(function ($query) {
            $query->whereNull('unblock_date')
                ->orWhere('unblock_date', '>', Carbon::now());
        })->exists();
    }

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

    public function stats()
    {
        return $this->hasOne('App\Models\UserStats');
    }

    public function pendingtokens()
    {
        return $this->hasMany(Token::class)->where('status', 0)->orderBy('is_vip', 'DESC')
            ->orderBy('id', 'ASC');
    }

    public function clientpendingtokens()
    {

        return $this->hasMany(Token::class, 'client_id', 'id')->whereIn('status', ['0', '3'])->orderBy('created_at', 'DESC')
            ->orderBy('id', 'ASC');
    }

    public function clienttokenhistory()
    {

        return $this->hasMany(Token::class, 'client_id', 'id')->where('status', 1)->orderBy('created_at', 'DESC')
            ->orderBy('id', 'ASC');
    }

    public function lasttoken()
    {
        return $this->hasOne(Token::class, 'client_id', 'id')->where('status', 1)->orderBy('is_vip', 'DESC')
            ->orderBy('id', 'ASC');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function officertokens()
    {
        return $this->hasMany(Token::class, 'user_id', 'id')->where('status', 1);
    }

    public function getServiceTimeAttribute()
    {
        $locationtokens = $this->officertokens();
        $servicecounter = 0;
        $servicetotal = 0;

        foreach ($locationtokens as $_locationtoken) {

            if ($_locationtoken->getServiceTimeMinutes() != null) {
                $servicetotal += $_locationtoken->getServiceTimeMinutes();
                $servicecounter++;
            }
        }

        return ($servicecounter > 0) ? ($servicetotal / $servicecounter) : 0;
    }


    public function getWaitTimeAttribute()
    {
        $locationtokens = $this->officertokens();
        $servicecounter = 0;
        $servicetotal = 0;

        foreach ($locationtokens as $_locationtoken) {

            if ($_locationtoken->getWaitTimeMinutes() != null) {
                $servicetotal += $_locationtoken->getWaitTimeMinutes();
                $servicecounter++;
            }
        }

        return ($servicecounter > 0) ? ($servicetotal / $servicecounter) : 0;
    }

    public function company()
    {
        return $this->hasOneThrough(
            Company::class,
            Location::class,
            'id', // Foreign key on the location table...
            'id', // Foreign key on the company table...
            'location_id', // Local key on the user table...
            'company_id' // Local key on the location table...
        );
    }

    public function getMaskedEmail()
    {
        return (new Utilities_lib)->maskEmail($this->email);
    }

    public function getCompletionPercentageAttribute()
    {
        $userInfoColumns = [
            'avatar',
            'company',
            'phone',
            'website',
            'country',
            'language',
            'timezone',
            'currency',
            'communication',
            'marketing',
            'gender',
            'date_of_birth',
        ];

        $totalColumns = count($userInfoColumns);
        $completedColumns = 0;

        foreach ($userInfoColumns as $column) {
            if (!is_null($this->userinfo->{$column})) {
                $completedColumns++;
            }
        }

        return round(($completedColumns / $totalColumns) * 100);
    }


    public function getCompletionColorAttribute()
    {
        $userInfoColumns = [
            'avatar',
            'company',
            'phone',
            'website',
            'country',
            'language',
            'timezone',
            'currency',
            'communication',
            'marketing',
            'gender',
            'date_of_birth',
        ];

        $totalColumns = count($userInfoColumns);
        $completedColumns = 0;

        foreach ($userInfoColumns as $column) {
            if (!is_null($this->userinfo->{$column})) {
                $completedColumns++;
            }
        }

        // Calculate the percentage of completed columns
        $completionPercentage = ($completedColumns / $totalColumns) * 100;

        // Determine the color based on the completion percentage
        if ($completionPercentage >= 80) {
            $color = 'success'; // Green
        } elseif ($completionPercentage >= 40) {
            $color = 'warning'; // Yellow
        } else {
            $color = 'danger'; // Red
        }

        return $color;
    }
}
