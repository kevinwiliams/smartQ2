<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class BusinessCategory extends Model
{
    use HasFactory;

    protected $table = "business_categories";
    protected $appends = ['company_count'];
    protected $fillable = ['name', 'description', 'logo'];

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function locations()
    {
        return $this->hasManyThrough(Location::class, Company::class);
    }

    public function getCompanyCountAttribute()
    {
        return count($this->companies);
    }

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
