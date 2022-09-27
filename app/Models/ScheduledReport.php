<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduledReport extends Model
{
    protected $table = "scheduled_reports";
    
    protected $fillable = ['name', 'email_to', 'active', 'report_id', 'schedule_type','start_date','schedule_info','user_id'];


    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
   protected $casts = [
       'active' => 'bool',
       'start_date' => 'datetime',
   ];
    protected $appends = ['report_name'];

    public function tasks()
    {
        return $this->hasMany(ScheduledReportsTask::class, "schedule_id", "id");
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function report()
    {
        $reports = \App\Core\Data::getReportList();
        $ids = array_column($reports, 'id');
        $found_key = array_search($this->report_id, $ids);
        return  $reports[$found_key];
    }

    public function getReportNameAttribute()
    {
        $reports = \App\Core\Data::getReportList();
        $ids = array_column($reports, 'id');
        $found_key = array_search($this->report_id, $ids);
        return  $reports[$found_key]['title'];        
    }
}
