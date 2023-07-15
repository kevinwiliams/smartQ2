<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VIPList extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $timestamps = true;

    protected $table = 'vip_list';
    
    protected $dates = ['created_at','updated_at','deleted_at'];

    protected $fillable = ['location_id','client_id','user_id','reason'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    } 

    public function client()
    {
        return $this->belongsTo(User::class,'client_id','id');
    } 

    public function location()
    {
        return $this->belongsTo(Location::class);
    } 
}
