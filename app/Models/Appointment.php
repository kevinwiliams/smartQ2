<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'finish_time',
        'comments',
        'client_id',
        'user_id',
        'location_id',
    ];
 
    public function client()
    {        
        return $this->belongsTo(User::class,'client_id','id');
    }
 
    public function employee()
    {
        return $this->belongsTo(User::class,'user_id','id');        
    }

    public function location()
    {
        return $this->belongsTo(Location::class,'location_id','id');        
    }
}