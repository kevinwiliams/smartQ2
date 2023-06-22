<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;
    protected $table = 'alerts';
    protected $primaryKey = 'alert_id';
    public $timestamps = true;

    protected $fillable = [
        'title',
        'message',
        'image_url',
        'start_date',
        'end_date',
        'active'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'active' => 'bool',
    ];

    protected $appends = [
        'location_names'        
    ];

    public function locations()
    {
        return $this->belongsToMany(Location::class, AlertLocations::class, 'alert_id', 'location_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    } 
     
    public function getLocationNamesAttribute()
    {
        return $this->locations->pluck('name')->implode(', ');
    }

}
