<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $table = 'invitation';

    protected $fillable = [
        'inviter', 'email', 'role_id', 'location_id', 'token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'inviter');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
