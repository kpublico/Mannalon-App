<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PhRegion extends Model
{
    protected $table = 'ph_regions';

    public $timestamps = false;

    public function provinces(): HasMany
    {
        return $this->hasMany(PhProvince::class, 'region_id', 'region_id');
    }
}
