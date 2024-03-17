<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'recipient_id',
        'location_id',
        'recipient',
        'channel',
        'subject',
        'message',        
        'status',
        'interaction_id',
        'interaction_message',        
        'response',
    ];
    
    public function sender() 
    {
    	return $this->hasOne(User::class, 'id', 'sender_id');
    }

    public function receiver() 
    {
    	return $this->hasOne(User::class, 'id', 'recipient_id');
    }

    public function location() 
    {
    	return $this->belongsTo(Location::class, 'id', 'location_id');
    }
}
