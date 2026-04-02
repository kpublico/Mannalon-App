<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhCity extends Model
{
    protected $table = 'ph_cities';

    public $timestamps = false;

    public function barangays(): HasMany
    {
        return $this->hasMany(PhBarangay::class, 'city_id', 'city_id');
    }
}
