<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = "company";

    protected $appends = ['location_count'];
    protected $fillable = ['name', 'address', 'website', 'email', 'phone', 'contact_person', 'description', 'active'];

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
}
