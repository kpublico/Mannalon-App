<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'date_of_birth',
        'age',
        'civil_status',
        'farm_location',
        'phone',
        'email',
        'government_id_type',
        'government_id_number',
        'region',
        'province',
        'municipality_city',
        'barangay',
        'sitio_purok',
        'gps_latitude',
        'gps_longitude',
        'land_boundary_points',
        'farmer_type',
        'years_in_farming',
        'primary_occupation',
        'secondary_occupation',
        'is_association_member',
        'association_name',
        'farm_size_hectares',
        'land_ownership_type',
        'number_of_parcels',
        'crop_types',
        'crop_area_per_type',
        'cropping_season',
        'yield_per_harvest',
        'livestock_types',
        'livestock_count',
        'farm_equipment',
        'irrigation_type',
        'water_source',
        'fertilizer_usage',
        'pesticide_usage',
        'average_monthly_income',
        'average_annual_income',
        'income_source',
        'has_credit_access',
        'insurance_coverage',
        'is_rsbsa_registered',
        'programs_availed',
        'program_registration_date',
        'valid_id_path',
        'land_document_path',
        'farm_photos_path',
        'barangay_certification_path',
        'registered_by',
        'profile_status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'program_registration_date' => 'date',
        'is_association_member' => 'boolean',
        'has_credit_access' => 'boolean',
        'is_rsbsa_registered' => 'boolean',
        'farm_size_hectares' => 'float',
        'average_monthly_income' => 'float',
        'average_annual_income' => 'float',
        'gps_latitude' => 'float',
        'gps_longitude' => 'float',
        'land_boundary_points' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function farmDetail()
    {
        return $this->hasOne(FarmDetail::class);
    }

    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }

    public function serviceAccessLogs()
    {
        return $this->hasMany(ServiceAccessLog::class);
    }

    public function modernProfile()
    {
        return $this->hasOne(FarmerProfile::class, 'legacy_farmer_id');
    }
}
