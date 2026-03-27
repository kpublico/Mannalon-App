<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('farmers', function (Blueprint $table): void {
            $table->string('first_name', 100)->nullable()->after('name');
            $table->string('middle_name', 100)->nullable()->after('first_name');
            $table->string('last_name', 100)->nullable()->after('middle_name');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('last_name');
            $table->date('date_of_birth')->nullable()->after('gender');
            $table->integer('age')->nullable()->after('date_of_birth');
            $table->enum('civil_status', ['single', 'married', 'divorced', 'widowed', 'separated'])->nullable()->after('age');
            $table->string('email')->nullable()->after('phone');
            $table->string('government_id_type', 60)->nullable()->after('email');
            $table->string('government_id_number', 120)->nullable()->after('government_id_type');

            $table->string('region', 120)->nullable()->after('government_id_number');
            $table->string('province', 120)->nullable()->after('region');
            $table->string('municipality_city', 120)->nullable()->after('province');
            $table->string('barangay', 120)->nullable()->after('municipality_city');
            $table->string('sitio_purok', 120)->nullable()->after('barangay');
            $table->decimal('gps_latitude', 10, 8)->nullable()->after('sitio_purok');
            $table->decimal('gps_longitude', 11, 8)->nullable()->after('gps_latitude');
            $table->longText('land_boundary_points')->nullable()->after('gps_longitude');

            $table->enum('farmer_type', ['owner', 'tenant', 'farm_worker'])->nullable()->after('gps_longitude');
            $table->integer('years_in_farming')->nullable()->after('farmer_type');
            $table->string('primary_occupation', 150)->nullable()->after('years_in_farming');
            $table->string('secondary_occupation', 150)->nullable()->after('primary_occupation');
            $table->boolean('is_association_member')->default(false)->after('secondary_occupation');
            $table->string('association_name', 180)->nullable()->after('is_association_member');

            $table->decimal('farm_size_hectares', 10, 2)->nullable()->after('farm_location');
            $table->enum('land_ownership_type', ['owned', 'leased', 'shared'])->nullable()->after('farm_size_hectares');
            $table->integer('number_of_parcels')->nullable()->after('land_ownership_type');

            $table->text('crop_types')->nullable()->after('number_of_parcels');
            $table->text('crop_area_per_type')->nullable()->after('crop_types');
            $table->enum('cropping_season', ['wet', 'dry', 'wet_dry'])->nullable()->after('crop_area_per_type');
            $table->string('yield_per_harvest', 120)->nullable()->after('cropping_season');
            $table->text('livestock_types')->nullable()->after('yield_per_harvest');
            $table->integer('livestock_count')->nullable()->after('livestock_types');

            $table->text('farm_equipment')->nullable()->after('livestock_count');
            $table->enum('irrigation_type', ['rainfed', 'irrigated', 'mixed'])->nullable()->after('farm_equipment');
            $table->string('water_source', 120)->nullable()->after('irrigation_type');
            $table->enum('fertilizer_usage', ['organic', 'inorganic', 'mixed'])->nullable()->after('water_source');
            $table->text('pesticide_usage')->nullable()->after('fertilizer_usage');

            $table->decimal('average_monthly_income', 12, 2)->nullable()->after('pesticide_usage');
            $table->decimal('average_annual_income', 12, 2)->nullable()->after('average_monthly_income');
            $table->enum('income_source', ['farm', 'non_farm', 'both'])->nullable()->after('average_annual_income');
            $table->boolean('has_credit_access')->default(false)->after('income_source');
            $table->string('insurance_coverage', 150)->nullable()->after('has_credit_access');

            $table->boolean('is_rsbsa_registered')->default(false)->after('insurance_coverage');
            $table->text('programs_availed')->nullable()->after('is_rsbsa_registered');
            $table->date('program_registration_date')->nullable()->after('programs_availed');

            $table->string('valid_id_path')->nullable()->after('program_registration_date');
            $table->string('land_document_path')->nullable()->after('valid_id_path');
            $table->string('farm_photos_path')->nullable()->after('land_document_path');
            $table->string('barangay_certification_path')->nullable()->after('farm_photos_path');

            $table->foreignId('registered_by')->nullable()->constrained('users')->nullOnDelete()->after('barangay_certification_path');
            $table->enum('profile_status', ['active', 'inactive', 'verified'])->default('active')->after('registered_by');

            $table->index('first_name');
            $table->index('last_name');
            $table->index('profile_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('farmers', function (Blueprint $table): void {
            $table->dropConstrainedForeignId('registered_by');
            $table->dropIndex(['first_name']);
            $table->dropIndex(['last_name']);
            $table->dropIndex(['profile_status']);

            $table->dropColumn([
                'first_name',
                'middle_name',
                'last_name',
                'gender',
                'date_of_birth',
                'age',
                'civil_status',
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
                'profile_status',
            ]);
        });
    }
};
