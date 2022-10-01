<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TokenSetting extends Model
{
    protected $table = "token_setting";


    public function location()
    {
        return $this->hasOne(Location::class,'id','location_id');
    }

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function department()
    {
        return $this->hasOne(Department::class,'id','department_id');
    }

    public function counter()
    {
        return $this->hasOne(Counter::class,'id','counter_id');
    }
}
