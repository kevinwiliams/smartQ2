<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledReportsTask extends Model
{
    use HasFactory;
    protected $table = "scheduled_reports_tasks";
    
    public function report()
    {
        return $this->belongsTo(ScheduledReport::class, "id", "schedule_id");
    }
}
