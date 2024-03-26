<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRating extends Model
{
    use HasFactory;
    protected $table = "customer_ratings";

    protected $fillable = [
        'user_id',
        'token_id',
        'status',
        'additional_comments',
        'current_step',
        'max_step',
        'config',
    ];

    public function ratingMetrics()
    {
        return $this->hasMany(RatingMetric::class);
    }
}
