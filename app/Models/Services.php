<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Services extends Model
{
    use HasFactory;

    protected $fillable = ['location_id', 'name', 'description', 'price_range_start', 'price_range_end', 'status'];

    protected $casts = [
        'status' => 'bool',
    ];

    public $appends = ['price'];

    public function getPriceAttribute()
    {
        if ($this->price_range_start == $this->price_range_end)
            return '$' . number_format($this->price_range_start, 2);
        else
            return  '$' . number_format($this->price_range_start, 2) . ' - $' . number_format($this->price_range_end, 2);
    }
}
