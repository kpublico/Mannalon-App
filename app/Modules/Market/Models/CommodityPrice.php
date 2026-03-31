<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommodityPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'commodity',
        'price_per_kilo',
        'date_updated',
        'source_market',
        'updated_by',
    ];

    protected $casts = [
        'date_updated' => 'date',
        'price_per_kilo' => 'decimal:2',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
