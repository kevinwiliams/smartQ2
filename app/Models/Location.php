<?php

namespace App\Models;

use App\models\DisplayCustom;
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
}
