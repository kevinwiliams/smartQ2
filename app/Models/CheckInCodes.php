<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckInCodes extends Model
{
    protected $table = 'check_in_codes';
    protected $fillable = ['location_id', 'code'];
}
