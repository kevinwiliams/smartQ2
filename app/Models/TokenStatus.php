<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokenStatus extends Model
{
    protected $table = "token_status";
    public $timestamps = false;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['token_id','status'];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [        
        'time_stamp' => 'datetime'
    ];
}
