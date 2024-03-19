<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Magic extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "magic";
    protected $fillable = ['token','url','signed_url'];

}
