<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhProvince extends Model
{
    protected $table = 'ph_provinces';

    public $timestamps = false;

    public function cities(): HasMany
    {
        return $this->hasMany(PhCity::class, 'province_id', 'province_id');
    }
}
