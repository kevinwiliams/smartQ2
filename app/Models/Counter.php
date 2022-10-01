<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $table = 'counter';

    public function visitreasons()
    {
        return $this->hasManyThrough(ReasonForVisit::class, ReasonForVisitCounters::class, 'counter_id', 'id', 'id', 'reason_id')->orderBy('reason', 'ASC');
    }
}
