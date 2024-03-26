<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingMetric extends Model
{
    use HasFactory;
    protected $table = "rating_metric";
    
    protected $fillable = [
        'customer_rating_id',
        'metric_id',
        'rating',
    ];

    public function customerRating()
    {
        return $this->belongsTo(CustomerRating::class);
    }
}
