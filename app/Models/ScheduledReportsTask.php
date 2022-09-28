<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledReportsTask extends Model
{
    use HasFactory;
    protected $table = "scheduled_reports_tasks";

    protected $casts = [
        'run_time' => 'datetime',
        'executed_time' => 'datetime',
    ];
    
    public function report()
    {
        return $this->belongsTo(ScheduledReport::class, "schedule_id", "id");
    }
}
