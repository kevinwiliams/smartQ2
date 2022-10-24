<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    protected $table = "token";
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'started_at' => 'datetime',
        'is_vip' => 'bool',
        'no_show' => 'bool',
        'token_date' => 'datetime',
        'push_notifications' => 'bool'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['wait_time', 'service_time'];

    public function department()
    {
        return $this->hasOne('App\Models\Department', 'id', 'department_id');
    }

    public function counter()
    {
        return $this->hasOne('App\Models\Counter', 'id', 'counter_id');
    }

    public function officer()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function generated_by()
    {
        return $this->hasOne('App\Models\User', 'id', 'created_by');
    }

    public function client()
    {
        return $this->hasOne('App\Models\User', 'id', 'client_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function status()
    {
        return $this->hasMany(TokenStatus::class);
    }

    public function getWaitTimeAttribute()
    {
        $start = $this->hasOne(TokenStatus::class)->ofMany([
            'time_stamp' => 'min',
            'id' => 'max',
        ], function ($query) {
            $query->where('status', '0');
        })->first();

        $end = $this->started_at;

        if ($start == null || $end == null) {
            return null;
        }

        // $to_time = strtotime($start->time_stamp);
        // $from_time = strtotime($end);
        // return round(abs($to_time - $from_time) / 60,2); 

        $date1 = new \DateTime($start->time_stamp);
        $date2 = new \DateTime($end);
        $diff  = $date2->diff($date1);
        $complete_time = (($diff->d > 0) ? " $diff->d Days " : null) . "$diff->h hrs $diff->i mins ";

        return  $complete_time;
    }

    public function getWaitTimeMinutes()
    {
        $start = $this->hasOne(TokenStatus::class)->ofMany([
            'time_stamp' => 'min',
            'id' => 'max',
        ], function ($query) {
            $query->where('status', '0');
        })->first();

        $end = $this->started_at;

        if ($start == null || $end == null) {
            return null;
        }

        // $to_time = strtotime($start->time_stamp);
        // $from_time = strtotime($end);
        // return round(abs($to_time - $from_time) / 60,2); 

        $date1 = new \DateTime($start->time_stamp);
        $date2 = new \DateTime($end);
        $diff  = $date2->diff($date1);        

        $minutes = $diff->days * 24 * 60;
        $minutes += $diff->h * 60;
        $minutes += $diff->i;
        return $minutes;
    }

    public function getServiceTimeAttribute()
    {
        $start = $this->started_at;
        $end = $this->hasOne(TokenStatus::class)->ofMany([
            'time_stamp' => 'min',
            'id' => 'max',
        ], function ($query) {
            $query->where('status', '1');
        })->first();



        if ($start == null || $end == null) {
            return null;
        }

        // $to_time = strtotime($start);
        // $from_time = strtotime($end->time_stamp);
        // return round(abs($to_time - $from_time) / 60,2); 
        $date1 = new \DateTime($start);
        $date2 = new \DateTime($end->time_stamp);
        $diff  = $date2->diff($date1);
        $complete_time = (($diff->d > 0) ? " $diff->d Days " : null) . "$diff->h hrs $diff->i mins ";

        return  $complete_time;
    }

    public function getServiceTimeMinutes()
    {
        $start = $this->started_at;
        $end = $this->hasOne(TokenStatus::class)->ofMany([
            'time_stamp' => 'min',
            'id' => 'max',
        ], function ($query) {
            $query->where('status', '1');
        })->first();



        if ($start == null || $end == null) {
            return null;
        }

        // $to_time = strtotime($start);
        // $from_time = strtotime($end->time_stamp);
        // return round(abs($to_time - $from_time) / 60,2); 
        $date1 = new \DateTime($start);
        $date2 = new \DateTime($end->time_stamp);
        $diff  = $date2->diff($date1);
        // $complete_time = (($diff->d > 0) ? " $diff->d Days " : null) . "$diff->h hrs $diff->i mins ";
        
        $minutes = $diff->days * 24 * 60;
        $minutes += $diff->h * 60;
        $minutes += $diff->i;
        return $minutes;
    }
}
