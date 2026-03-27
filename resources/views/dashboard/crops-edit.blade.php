@extends('layouts.app')

@section('title', 'Edit Crop')

@section('content')
<div class="card">
    <a href="{{ route('crops.index') }}" style="color: #2ecc71; text-decoration: none;">← Back to Crops</a>
    <h2 style="margin-top: 1rem;">Edit Crop</h2>
</div>

<div style="max-width: 600px; margin: 0 auto;">
    <div class="card">
        <form method="POST" action="{{ route('crops.update', $crop->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Crop Name *</label>
                <input type="text" id="name" name="name" required value="{{ old('name', $crop->name) }}">
                @error('name') <span style="color: #e74c3c;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="area">Area (hectares) *</label>
                <input type="number" id="area" name="area" step="0.01" required value="{{ old('area', $crop->area) }}">
                @error('area') <span style="color: #e74c3c;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="planting_date">Planting Date *</label>
                <input type="date" id="planting_date" name="planting_date" required value="{{ old('planting_date', $crop->planting_date->format('Y-m-d')) }}">
                @error('planting_date') <span style="color: #e74c3c;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="expected_harvest_date">Expected Harvest Date *</label>
                <input type="date" id="expected_harvest_date" name="expected_harvest_date" required value="{{ old('expected_harvest_date', $crop->expected_harvest_date->format('Y-m-d')) }}">
                @error('expected_harvest_date') <span style="color: #e74c3c;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="status">Status *</label>
                <select id="status" name="status" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px;">
                    <option value="Planting" {{ old('status', $crop->status) === 'Planting' ? 'selected' : '' }}>Planting</option>
                    <option value="Growing" {{ old('status', $crop->status) === 'Growing' ? 'selected' : '' }}>Growing</option>
                    <option value="Flowering" {{ old('status', $crop->status) === 'Flowering' ? 'selected' : '' }}>Flowering</option>
                    <option value="Ready for Harvest" {{ old('status', $crop->status) === 'Ready for Harvest' ? 'selected' : '' }}>Ready for Harvest</option>
                    <option value="Harvested" {{ old('status', $crop->status) === 'Harvested' ? 'selected' : '' }}>Harvested</option>
                </select>
                @error('status') <span style="color: #e74c3c;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4">{{ old('description', $crop->description) }}</textarea>
            </div>

            <button type="submit" style="width: 100%;">Update Crop</button>
        </form>
    </div>
</div>
@endsection
