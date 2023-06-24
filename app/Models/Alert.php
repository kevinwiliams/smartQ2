<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'active' => 'bool',
    ];

    protected $appends = [
        'location_names','image_path'        
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

    public function getImagePathAttribute()
    {
        // if file avatar exist in storage folder
        $avatar = public_path(Storage::url($this->image_url));
        if (is_file($avatar) && file_exists($avatar)) {
            // get avatar url from storage
            return Storage::url($this->image_url);
        }

        // check if the avatar is an external url, eg. image from google
        if (filter_var($this->image_url, FILTER_VALIDATE_URL)) {
            return $this->image_url;
        }

        // no avatar, return blank avatar
        return asset(theme()->getMediaUrlPath() . 'media/icons/duotune/general/gen006.svg');
    }
    
}
