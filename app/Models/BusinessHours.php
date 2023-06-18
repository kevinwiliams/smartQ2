<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessHours extends Model
{
    use HasFactory;

    protected $table = "business_hours";

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];

    protected $appends = ['open_hours', 'is_open'];

    protected $fillable = ['location_id', 'start_time', 'end_time', 'day'];

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id', 'id');
    }

    public function getOpenHoursAttribute()
    {
        $start = Carbon::parse($this->start_time);
        $end = Carbon::parse($this->end_time);
        $diff =  $start->diffInMinutes($end);
        switch ($diff) {
            case 1440:
                return "All Day";
                break;
            case 0:
                return "Closed";
                break;
            default:
                return Carbon::parse($this->start_time)->format('h:i A') . " to "  . Carbon::parse($this->end_time)->format('h:i A');
                break;
        }        
    }

    public function getIsOpenAttribute()
    {
        $start = Carbon::parse($this->start_time);
        $end = Carbon::parse($this->end_time);
        $diff =  $start->diffInMinutes($end);
        switch ($diff) {
            case 1440:
                return "all";
                break;
            case 0:
                return "false";
                break;
            default:
                return "true";
                break;
        }
        // return $diff;
        //return Carbon::parse($this->start_time)->format('h:i A') . " to "  . Carbon::parse($this->end_time)->format('h:i A');
    }
}
