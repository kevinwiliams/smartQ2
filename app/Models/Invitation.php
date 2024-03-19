<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invitation extends Model
{
    use HasFactory;
    use SoftDeletes;

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
