<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReasonForVisitCounters extends Model
{
    use HasFactory;

    public function counter()
    {
        return $this->hasOne(Counter::class);
    }

    public function reasons()
    {
        return $this->hasOne(ReasonForVisit::class);
    }
}
