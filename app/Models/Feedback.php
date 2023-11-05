<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'comment',
        'type',                
        'user_agent',
        'ip_address',
        'os_version',
        'browser_version',
        'rating',
        'category',
        'source',    
        'status',
        'assigned_to',
        'feedback_response',
        'resolved_at',
        'resolution_notes',
    ];

    protected $dates = ['created_at', 'updated_at', 'resolved_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function queue()
    {
        return $this->belongsTo(Queue::class, 'queue_id');
    }

}
