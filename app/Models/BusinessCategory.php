<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
    use HasFactory;

    protected $table = "business_categories";
    protected $appends = ['company_count'];
    protected $fillable = ['name', 'description'];

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
}
