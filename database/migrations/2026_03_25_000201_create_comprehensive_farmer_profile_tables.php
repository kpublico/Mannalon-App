<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations - Create comprehensive farmer profile system.
     */
    public function up(): void
    {
        // 1. Extended Farmer Personal Information Table
        Schema::create('farmer_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->string('full_name', 150);
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('age')->nullable();
            $table->enum('civil_status', ['single', 'married', 'divorced', 'widowed'])->nullable();
            $table->string('contact_number', 20)->nullable();
            $table->string('government_id_type', 50)->nullable(); // PhilSys ID, Voter's ID, etc.
            $table->string('government_id_number', 100)->nullable();
            $table->timestamps();
            $table->index('user_id');
        });

        // 2. Address Information Table
        Schema::create('farmer_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_profile_id')->constrained('farmer_profiles')->onDelete('cascade');
            $table->enum('address_type', ['home', 'farm', 'other'])->default('home');
            $table->string('region', 100)->nullable();
            $table->string('province', 100)->nullable();
            $table->string('municipality_city', 100)->nullable();
            $table->string('barangay', 100)->nullable();
            $table->string('sitio_purok', 100)->nullable();
            $table->string('detailed_address', 255)->nullable();
            $table->decimal('gps_latitude', 10, 8)->nullable();
            $table->decimal('gps_longitude', 11, 8)->nullable();
            $table->timestamps();
            $table->index('farmer_profile_id');
        });

        // 3. Farming Profile/Role Information Table
        Schema::create('farming_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_profile_id')->unique()->constrained('farmer_profiles')->onDelete('cascade');
            $table->enum('farmer_type', ['owner', 'tenant', 'farm_worker', 'cooperative_member'])->default('owner');
            $table->integer('years_in_farming')->nullable();
            $table->string('primary_occupation', 150)->nullable();
            $table->string('secondary_occupation', 150)->nullable();
            $table->string('farmers_association', 150)->nullable();
            $table->enum('association_membership_status', ['member', 'non_member', 'pending'])->default('non_member');
            $table->date('association_joined_date')->nullable();
            $table->timestamps();
            $table->index('farmer_profile_id');
        });

        // 4. Farm Information Table
        Schema::create('farm_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_profile_id')->constrained('farmer_profiles')->onDelete('cascade');
            $table->string('farm_name', 150)->nullable();
            $table->decimal('farm_size_hectares', 10, 2)->nullable();
            $table->enum('land_ownership_type', ['owned', 'leased', 'shared', 'mortgaged'])->default('owned');
            $table->integer('number_of_parcels')->default(1);
            $table->text('farm_description')->nullable();
            $table->date('ownership_date')->nullable();
            $table->timestamps();
            $table->index('farmer_profile_id');
        });

        // 5. Farm Parcels/Sub-plots Table
        Schema::create('farm_parcels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_record_id')->constrained('farm_records')->onDelete('cascade');
            $table->string('parcel_name', 100)->nullable();
            $table->decimal('parcel_size_hectares', 10, 2)->nullable();
            $table->string('soil_type', 100)->nullable();
            $table->string('terrain_type', 100)->nullable(); // flat, hilly, mountainous
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->enum('status', ['active', 'inactive', 'fallow'])->default('active');
            $table->timestamps();
            $table->index('farm_record_id');
        });

        // 6. Farm Equipment/Resources Table
        Schema::create('farm_equipment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_record_id')->constrained('farm_records')->onDelete('cascade');
            $table->string('equipment_name', 150);
            $table->enum('equipment_type', ['tractor', 'plow', 'harvester', 'thresher', 'irrigation_pump', 'sprayer', 'other'])->default('other');
            $table->string('equipment_description', 255)->nullable();
            $table->enum('ownership_status', ['owned', 'borrowed', 'rented', 'shared'])->default('owned');
            $table->date('purchase_date')->nullable();
            $table->decimal('equipment_cost', 12, 2)->nullable();
            $table->enum('condition', ['excellent', 'good', 'fair', 'poor'])->default('good');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index('farm_record_id');
        });

        // 7. Irrigation & Water Resources Table
        Schema::create('farm_water_resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_record_id')->constrained('farm_records')->onDelete('cascade');
            $table->enum('irrigation_type', ['rainfed', 'irrigated', 'mixed'])->default('rainfed');
            $table->enum('water_source', ['well', 'river', 'pump', 'canal', 'spring', 'municipal', 'rainwater_harvestinf'])->nullable();
            $table->string('water_quality_rating', 50)->nullable(); // Good, Fair, Poor
            $table->decimal('annual_water_cost', 10, 2)->nullable();
            $table->enum('water_availability', ['adequate', 'moderate', 'scarce', 'seasonal'])->default('adequate');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index('farm_record_id');
        });

        // 8. Farming Inputs (Fertilizer, Pesticides, Seeds)
        Schema::create('farm_inputs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_record_id')->constrained('farm_records')->onDelete('cascade');
            $table->enum('input_type', ['fertilizer', 'pesticide', 'herbicide', 'fungicide', 'seeds', 'other'])->default('fertilizer');
            $table->string('input_name', 150);
            $table->enum('input_category', ['organic', 'inorganic', 'bio_based'])->default('inorganic');
            $table->decimal('annual_quantity_used', 10, 2)->nullable();
            $table->string('unit_of_measurement', 50)->nullable(); // kg, liters, pieces
            $table->decimal('annual_cost', 12, 2)->nullable();
            $table->string('supplier_name', 150)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index('farm_record_id');
        });

        // 9. Financial Records/Income Table
        Schema::create('farmer_financial_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_profile_id')->constrained('farmer_profiles')->onDelete('cascade');
            $table->date('record_date');
            $table->decimal('farm_income_monthly', 12, 2)->nullable();
            $table->decimal('farm_income_annual', 12, 2)->nullable();
            $table->decimal('non_farm_income_monthly', 12, 2)->nullable();
            $table->decimal('non_farm_income_annual', 12, 2)->nullable();
            $table->decimal('total_expenses_annual', 12, 2)->nullable();
            $table->decimal('net_income_annual', 12, 2)->nullable();
            $table->enum('income_stability', ['stable', 'fluctuating', 'declining', 'growing'])->nullable();
            $table->text('income_sources')->nullable(); // JSON or text describing sources
            $table->timestamps();
            $table->index('farmer_profile_id');
        });

        // 10. Credit & Loan Information Table
        Schema::create('farmer_credit_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_profile_id')->constrained('farmer_profiles')->onDelete('cascade');
            $table->enum('credit_access', ['yes', 'no', 'limited'])->default('no');
            $table->string('credit_source', 150)->nullable(); // Bank, Cooperative, Informal, etc.
            $table->decimal('total_loan_amount', 12, 2)->nullable();
            $table->decimal('outstanding_loan_balance', 12, 2)->nullable();
            $table->decimal('loan_interest_rate', 5, 2)->nullable();
            $table->date('loan_start_date')->nullable();
            $table->date('loan_maturity_date')->nullable();
            $table->enum('loan_repayment_status', ['active', 'on_schedule', 'delayed', 'overdue', 'paid_off'])->default('active');
            $table->text('collateral_description')->nullable();
            $table->timestamps();
            $table->index('farmer_profile_id');
        });

        // 11. Insurance Coverage Table
        Schema::create('farmer_insurance_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_profile_id')->constrained('farmer_profiles')->onDelete('cascade');
            $table->enum('insurance_type', ['crop_insurance', 'livestock_insurance', 'health_insurance', 'accident_insurance'])->default('crop_insurance');
            $table->string('insurance_provider', 150)->nullable(); // e.g., PCIC
            $table->string('policy_number', 100)->nullable();
            $table->date('policy_start_date')->nullable();
            $table->date('policy_end_date')->nullable();
            $table->decimal('premium_amount', 10, 2)->nullable();
            $table->decimal('coverage_amount', 12, 2)->nullable();
            $table->enum('status', ['active', 'expired', 'suspended', 'claimed'])->default('active');
            $table->text('coverage_details')->nullable();
            $table->timestamps();
            $table->index('farmer_profile_id');
        });

        // 12. Government Program Participation Table
        Schema::create('government_program_participation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_profile_id')->constrained('farmer_profiles')->onDelete('cascade');
            $table->string('rsbsa_number', 100)->nullable(); // Registry System for Basic Sectors in Agriculture
            $table->date('rsbsa_registration_date')->nullable();
            $table->enum('rsbsa_status', ['registered', 'unregistered', 'pending_verification'])->default('unregistered');
            $table->timestamps();
            $table->index('farmer_profile_id');
            $table->index('rsbsa_number');
        });

        // 13. Program Benefits Availed Table
        Schema::create('program_benefits_availed', function (Blueprint $table) {
            $table->id();
            $table->foreignId('government_program_id')->constrained('government_program_participation')->onDelete('cascade');
            $table->enum('benefit_type', ['seeds_distribution', 'fertilizer_subsidy', 'training_seminar', 'equipment_support', 'loan_assistance', 'other'])->default('other');
            $table->string('program_name', 150);
            $table->text('program_description')->nullable();
            $table->date('benefit_date');
            $table->decimal('benefit_value', 12, 2)->nullable();
            $table->string('benefit_unit', 100)->nullable(); // e.g., "50 kg", "2 units", "15 hours"
            $table->enum('status', ['received', 'pending', 'approved', 'rejected', 'cancelled'])->default('pending');
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->index('government_program_id');
        });

        // 14. Document/Attachment Storage Table
        Schema::create('farmer_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_profile_id')->constrained('farmer_profiles')->onDelete('cascade');
            $table->enum('document_type', ['government_id', 'land_title', 'lease_agreement', 'certification', 'farm_photo', 'proof_of_income', 'bank_statement', 'other'])->default('other');
            $table->string('document_name', 255);
            $table->string('file_path', 500);
            $table->string('file_mime_type', 50)->nullable(); // e.g., application/pdf
            $table->unsignedBigInteger('file_size')->nullable(); // in bytes
            $table->date('document_issue_date')->nullable();
            $table->date('document_expiry_date')->nullable();
            $table->enum('verification_status', ['unverified', 'verified', 'rejected', 'pending_review'])->default('unverified');
            $table->string('verified_by', 150)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index('farmer_profile_id');
            $table->index('document_type');
        });

        // 15. Audit Trail / System Information (for tracking changes)
        Schema::create('farmer_audit_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farmer_profile_id')->constrained('farmer_profiles')->onDelete('cascade');
            $table->foreignId('admin_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('action', ['created', 'updated', 'verified', 'deactivated', 'document_uploaded', 'program_enrolled'])->default('created');
            $table->string('entity_type', 100)->nullable(); // Profile, Address, Farm, etc.
            $table->text('changes_made')->nullable(); // JSON format
            $table->string('ip_address', 45)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index('farmer_profile_id');
            $table->index('admin_user_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmer_audit_log');
        Schema::dropIfExists('farmer_documents');
        Schema::dropIfExists('program_benefits_availed');
        Schema::dropIfExists('government_program_participation');
        Schema::dropIfExists('farmer_insurance_records');
        Schema::dropIfExists('farmer_credit_records');
        Schema::dropIfExists('farmer_financial_records');
        Schema::dropIfExists('farm_inputs');
        Schema::dropIfExists('farm_water_resources');
        Schema::dropIfExists('farm_equipment');
        Schema::dropIfExists('farm_parcels');
        Schema::dropIfExists('farm_records');
        Schema::dropIfExists('farming_profiles');
        Schema::dropIfExists('farmer_addresses');
        Schema::dropIfExists('farmer_profiles');
    }
};
