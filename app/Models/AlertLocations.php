<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertLocations extends Model
{
    use HasFactory;
    protected $fillable = [
        'alert_id',
        'location_id'
    ];
}
