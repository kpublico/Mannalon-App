<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmInput extends Model
{
    use HasFactory;

    protected $table = 'farm_inputs';

    protected $fillable = [
        'farm_record_id',
        'input_type',
        'input_name',
        'input_category',
        'annual_quantity_used',
        'unit_of_measurement',
        'annual_cost',
        'supplier_name',
        'notes',
    ];

    protected $casts = [
        'annual_quantity_used' => 'float',
        'annual_cost' => 'float',
    ];

    public function farmRecord()
    {
        return $this->belongsTo(FarmRecord::class);
    }

    public function isOrganic(): bool
    {
        return $this->input_category === 'organic';
    }
}
