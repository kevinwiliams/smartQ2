<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorites extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'favorites';
    protected $primaryKey = 'id';
    protected $fillable = [
        'location_id',
        'user_id',
    ];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function visits()
    {
        return $this->hasMany(Token::class, 'location_id', 'location_id')
            ->where('client_id', $this->user_id)
            ->where('status', 1); 
    }

    public function totalVisits()
    {        
        return $this->visits->count();        
    }

    public function lastVisit()
    {
        if ($this->visits)
            return $this->visits->sortByDesc('created_at')->first();
        else
            return null;
    }
}
