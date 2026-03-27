<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramBenefitAvailed extends Model
{
    use HasFactory;

    protected $table = 'program_benefits_availed';

    protected $fillable = [
        'government_program_id',
        'benefit_type',
        'program_name',
        'program_description',
        'benefit_date',
        'benefit_value',
        'benefit_unit',
        'status',
        'remarks',
    ];

    protected $casts = [
        'benefit_date' => 'date',
        'benefit_value' => 'float',
    ];

    public function governmentProgram()
    {
        return $this->belongsTo(GovernmentProgramParticipation::class, 'government_program_id');
    }

    public function isReceived(): bool
    {
        return $this->status === 'received';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }
}
