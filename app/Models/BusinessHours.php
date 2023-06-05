<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessHours extends Model
{
    use HasFactory;

    protected $table = "business_hours";
    
    protected $fillable = ['location_id', 'start_time', 'end_time','day'];

    public function location()
    {
        return $this->belongsTo(Location::class,'location_id','id');        
    }

}
