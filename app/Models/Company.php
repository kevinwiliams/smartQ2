<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Company extends Model
{
    use HasFactory;
    protected $table = "company";

    protected $appends = ['location_count', 'logo_url'];
    protected $fillable = ['name', 'address', 'website', 'email', 'phone', 'contact_person', 'description', 'active', 'business_category_id', 'logo', 'shortname'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'bool',
    ];

    public function getLocationCountAttribute()
    {
        return count($this->locations);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function category()
    {
        return $this->belongsTo(BusinessCategory::class, 'business_category_id', 'id');
    }

    // public function getCategoryNameAttribute()
    // {        
    //     if ($this->category != null) {
    //         return $this->category->name;
    //     } else {
    //         return "";
    //     }
    // }

    public function getLogoUrlAttribute()
    {
        // if file avatar exist in storage folder
        $avatar = public_path(Storage::url($this->logo));
        if (is_file($avatar) && file_exists($avatar)) {
            // get avatar url from storage
            return Storage::url($this->logo);
        }

        // check if the avatar is an external url, eg. image from google
        if (filter_var($this->logo, FILTER_VALIDATE_URL)) {
            return $this->logo;
        }

        // no avatar, return blank avatar
        return asset(theme()->getMediaUrlPath() . 'media/icons/duotune/general/gen006.svg');
    }
}
