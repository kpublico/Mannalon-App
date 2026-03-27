@extends('layouts.app')

@section('title', 'Add Crop')

@section('content')
<div class="card">
    <a href="{{ route('crops.index') }}" style="color: #2ecc71; text-decoration: none;">← Back to Crops</a>
    <h2 style="margin-top: 1rem;">Add New Crop</h2>
</div>

<div style="max-width: 600px; margin: 0 auto;">
    <div class="card">
        <form method="POST" action="{{ route('crops.store') }}">
            @csrf

            <div class="form-group">
                <label for="name">Crop Name *</label>
                <input type="text" id="name" name="name" required value="{{ old('name') }}">
                @error('name') <span style="color: #e74c3c;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="area">Area (hectares) *</label>
                <input type="number" id="area" name="area" step="0.01" required value="{{ old('area') }}">
                @error('area') <span style="color: #e74c3c;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="planting_date">Planting Date *</label>
                <input type="date" id="planting_date" name="planting_date" required value="{{ old('planting_date') }}">
                @error('planting_date') <span style="color: #e74c3c;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="expected_harvest_date">Expected Harvest Date *</label>
                <input type="date" id="expected_harvest_date" name="expected_harvest_date" required value="{{ old('expected_harvest_date') }}">
                @error('expected_harvest_date') <span style="color: #e74c3c;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px;">
                    <option value="">-- Select Status --</option>
                    <option value="Planting" {{ old('status') === 'Planting' ? 'selected' : '' }}>Planting</option>
                    <option value="Growing" {{ old('status') === 'Growing' ? 'selected' : '' }}>Growing</option>
                    <option value="Flowering" {{ old('status') === 'Flowering' ? 'selected' : '' }}>Flowering</option>
                    <option value="Ready for Harvest" {{ old('status') === 'Ready for Harvest' ? 'selected' : '' }}>Ready for Harvest</option>
                    <option value="Harvested" {{ old('status') === 'Harvested' ? 'selected' : '' }}>Harvested</option>
                </select>
                @error('status') <span style="color: #e74c3c;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4">{{ old('description') }}</textarea>
            </div>

            <button type="submit" style="width: 100%;">Add Crop</button>
        </form>
    </div>
</div>
@endsection
