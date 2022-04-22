<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationStats extends Model
{
    protected $table = "location_stats";
    public $timestamps = false;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

   protected $fillable = ['location_id','wait_time','service_time'];


   /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
   protected $casts = [        
       'updated_at' => 'datetime'
   ]; 
}
