<?php

namespace App\Models;

use App\Http\Controllers\Common\Utilities_lib;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = "locations";
    protected $fillable = ['company_id', 'address', 'name', 'lat', 'lon', 'active'];
    protected $appends = ['is_open_status'];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'bool',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function staff()
    {
        return $this->hasMany(User::class)
            ->where('user_type', '<>', 3);
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function counters()
    {
        return $this->hasMany(Counter::class);
    }

    public function displays()
    {
        return $this->hasMany(DisplayCustom::class);
    }

    public function settings()
    {
        return $this->hasOne(DisplaySetting::class);
    }

    public function stats()
    {
        return $this->hasOne(LocationStats::class)->first();
    }

    public function visitorslastweek()
    {
        $now = Carbon::now();
        $now->weekOfYear;
        $dates = (new Utilities_lib)->getStartAndEndDate($now->weekOfYear, $now->year);

        return $this->hasMany(Token::class)
            ->whereDate('created_at', '>=', $dates['week_start'])
            ->whereDate('created_at', '<=', $dates['week_end']);
    }

    public function openinghours()
    {
        return $this->hasMany(BusinessHours::class);
    }

    public function getIsOpenStatusAttribute()
    {        
        @date_default_timezone_set(session('app.timezone'));
        $currentTime = Carbon::now();
        $currentDayOfWeek = $currentTime->dayOfWeek;
        
        $currentBusinessHour = $this->openinghours()
            ->where('day', $currentDayOfWeek)
            ->first();

        if (!$currentBusinessHour) {
            return '';
        }

        $startTime = Carbon::parse($currentBusinessHour->start_time);
        $endTime = Carbon::parse($currentBusinessHour->end_time);

        if ($currentTime->isBetween($startTime, $endTime)) {
            $diff =  $currentTime->diffInMinutes($endTime);

            if($diff <= 30){
                $closingTime = $endTime->format('h:i A');
            
                return 'Closing Soon (Closes at ' . $closingTime . ')';
            }            

            return 'Open';
        }

        if ($startTime->isFuture()) {
            return 'Opening Soon';
        }

        if ($endTime->isPast()) {
            $nextBusinessHour = $this->openinghours()
                ->where('day', ($currentDayOfWeek + 1) % 7)
                ->orderBy('start_time')
                ->first();

            if (!$nextBusinessHour) {
                return 'Closed';
            }

            if ($nextBusinessHour->isClosed()) {
                return 'Closed';
            }

            $nextStartTime = Carbon::parse( $nextBusinessHour->start_time);
            return 'Opening Tomorrow at ' . $nextStartTime->format('h:i A');
        }

       
    }   

    public function services()
    {
        return $this->hasMany(Services::class);
    }

    public function alerts()
    {
        $currentTime = Carbon::now();

        return $this->belongsToMany(Alert::class, AlertLocations::class, 'location_id', 'alert_id')
            ->where('active', 1)
            ->where('start_date', '<=', $currentTime)
            ->where('end_date', '>=', $currentTime);
    }

    public function vips()
    {
        return $this->belongsToMany(User::class, 'vip_list', 'location_id', 'client_id')
        ->withPivot('client_id', 'reason')
        ->withTimestamps();
    }

    public function blacklist()
    {
        return $this->belongsToMany(User::class, 'blacklists', 'location_id', 'client_id')
        ->withPivot('client_id', 'block_reason', 'block_date')
        ->withTimestamps();
    }
}
