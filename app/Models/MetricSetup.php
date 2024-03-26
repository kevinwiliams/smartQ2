<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetricSetup extends Model
{
    use HasFactory;
    protected $table = "metrics_setup";

    protected $fillable = [
        'type',
        'name',
        'description',
        'active',
    ];
}
