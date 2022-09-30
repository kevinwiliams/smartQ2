<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReasonForVisit extends Model
{
    use HasFactory;

    protected $table = "reason_for_visit";

    protected $fillable = ['department_id', 'reason'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
