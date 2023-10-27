<?php

namespace App\Models;

use App\Core\Constants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationSetting extends Model
{
    protected $table = 'location_settings';

    protected $fillable = [
        'location_id',
        'key',
        'value',
    ];

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function getKeyNameAttribute()
    {
        $key = $this->key;
        $constantMap = Constants::$constantMap; 

        if (isset($key) && array_key_exists($key, $constantMap)) {
            return $constantMap[$key];
        }

        return $key;
    }
}
