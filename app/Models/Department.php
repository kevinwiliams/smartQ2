<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
	protected $table = "department";

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	public function stats()
	{
		return $this->hasOne('App\Models\DepartmentStats');
	}

	public function visitreasons()
	{
		return $this->hasMany(ReasonForVisit::class)->orderBy('reason', 'ASC');
	}
}
