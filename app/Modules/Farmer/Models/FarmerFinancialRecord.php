<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerFinancialRecord extends Model
{
    use HasFactory;

    protected $table = 'farmer_financial_records';

    protected $fillable = [
        'farmer_profile_id',
        'record_date',
        'farm_income_monthly',
        'farm_income_annual',
        'non_farm_income_monthly',
        'non_farm_income_annual',
        'total_expenses_annual',
        'net_income_annual',
        'income_stability',
        'income_sources',
    ];

    protected $casts = [
        'record_date' => 'date',
        'farm_income_monthly' => 'float',
        'farm_income_annual' => 'float',
        'non_farm_income_monthly' => 'float',
        'non_farm_income_annual' => 'float',
        'total_expenses_annual' => 'float',
        'net_income_annual' => 'float',
    ];

    public function farmerProfile()
    {
        return $this->belongsTo(FarmerProfile::class);
    }

    public function getTotalMonthlyIncome(): float
    {
        return ($this->farm_income_monthly ?? 0) + ($this->non_farm_income_monthly ?? 0);
    }

    public function getTotalAnnualIncome(): float
    {
        return ($this->farm_income_annual ?? 0) + ($this->non_farm_income_annual ?? 0);
    }
}
