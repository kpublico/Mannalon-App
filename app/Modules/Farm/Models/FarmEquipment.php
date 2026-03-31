<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmEquipment extends Model
{
    use HasFactory;

    protected $table = 'farm_equipment';

    protected $fillable = [
        'farm_record_id',
        'equipment_name',
        'equipment_type',
        'equipment_description',
        'ownership_status',
        'purchase_date',
        'equipment_cost',
        'condition',
        'notes',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'equipment_cost' => 'float',
    ];

    public function farmRecord()
    {
        return $this->belongsTo(FarmRecord::class);
    }

    public function isOwned(): bool
    {
        return $this->ownership_status === 'owned';
    }
}
