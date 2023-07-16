<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'blacklists';

    protected $dates = ['block_date', 'unblock_date', 'created_at', 'updated_at'];

    protected $fillable = ['location_id', 'client_id', 'user_id', 'block_reason', 'block_date', 'unblock_reason', 'unblock_date',];

    protected $appends = ['is_active', 'blocked_duration'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id', 'id');
    }

    public function getIsActiveAttribute()
    {
        if ($this->unblock_date == null)
            return true;

        if ($this->unblock_date < Carbon::now())
            return false;

        return true;
    }

    public function getBlockedDurationAttribute()
    {
        if ($this->unblock_date === null) {            
            return null;
        }

        $duration = $this->block_date->diffForHumans($this->unblock_date, CarbonInterface::DIFF_ABSOLUTE);
        return $duration;
    }
}
