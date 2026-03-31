<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerCreditRecord extends Model
{
    use HasFactory;

    protected $table = 'farmer_credit_records';

    protected $fillable = [
        'farmer_profile_id',
        'credit_access',
        'credit_source',
        'total_loan_amount',
        'outstanding_loan_balance',
        'loan_interest_rate',
        'loan_start_date',
        'loan_maturity_date',
        'loan_repayment_status',
        'collateral_description',
    ];

    protected $casts = [
        'total_loan_amount' => 'float',
        'outstanding_loan_balance' => 'float',
        'loan_interest_rate' => 'float',
        'loan_start_date' => 'date',
        'loan_maturity_date' => 'date',
    ];

    public function farmerProfile()
    {
        return $this->belongsTo(FarmerProfile::class);
    }

    public function hasAccessToCredit(): bool
    {
        return $this->credit_access === 'yes';
    }

    public function isOnSchedule(): bool
    {
        return $this->loan_repayment_status === 'on_schedule';
    }
}
