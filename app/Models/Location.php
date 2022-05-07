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
    protected $fillable = ['company_id', 'address', 'name', 'lat', 'lon','active'];


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

    public function users(){
        return $this->hasMany(User::class);
    }

    public function staff(){
        return $this->hasMany(User::class)
        ->where('user_type','<>',3);
    }

    public function departments(){
        return $this->hasMany(Department::class);
    }

    public function counters(){
        return $this->hasMany(Counter::class);
    }

    public function displays(){
        return $this->hasMany(DisplayCustom::class);
    }

    public function settings(){
        return $this->hasOne(DisplaySetting::class);
    }

    public function stats()
    {
        return $this->hasOne(LocationStats::class)->first();
    }

    public function visitorslastweek(){
        $now = Carbon::now();
        $now->weekOfYear;
        $dates = (new Utilities_lib)->getStartAndEndDate($now->weekOfYear,$now->year);

        return $this->hasMany(Token::class)
        ->whereDate('created_at','>=', $dates['week_start'])
        ->whereDate('created_at','<=', $dates['week_end']);        
    }
}
