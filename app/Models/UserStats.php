<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStats extends Model
{
    protected $table = "user_stats";
    public $timestamps = false;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

   protected $fillable = ['user_id','service_time'];


   /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
   protected $casts = [        
       'updated_at' => 'datetime'
   ]; 
}
