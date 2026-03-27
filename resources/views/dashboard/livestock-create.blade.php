@extends('layouts.app')

@section('title', 'Add Livestock')

@section('content')
<div class="card">
    <a href="{{ route('livestock.index') }}" style="color: #2ecc71; text-decoration: none;">← Back to Livestock</a>
    <h2 style="margin-top: 1rem;">Add Livestock</h2>
</div>

<div style="max-width: 600px; margin: 0 auto;">
    <div class="card">
        <form method="POST" action="{{ route('livestock.store') }}">
            @csrf

            <div class="form-group">
                <label for="type">Livestock Type *</label>
                <select id="type" name="type" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px;">
                    <option value="">-- Select Type --</option>
                    <option value="Cattle" {{ old('type') === 'Cattle' ? 'selected' : '' }}>Cattle</option>
                    <option value="Goats" {{ old('type') === 'Goats' ? 'selected' : '' }}>Goats</option>
                    <option value="Sheep" {{ old('type') === 'Sheep' ? 'selected' : '' }}>Sheep</option>
                    <option value="Poultry" {{ old('type') === 'Poultry' ? 'selected' : '' }}>Poultry</option>
                    <option value="Pigs" {{ old('type') === 'Pigs' ? 'selected' : '' }}>Pigs</option>
                    <option value="Horses" {{ old('type') === 'Horses' ? 'selected' : '' }}>Horses</option>
                </select>
                @error('type') <span style="color: #e74c3c;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="count">Count *</label>
                <input type="number" id="count" name="count" min="1" required value="{{ old('count') }}">
                @error('count') <span style="color: #e74c3c;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="health_status">Health Status *</label>
                <select id="health_status" name="health_status" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 4px;">
                    <option value="">-- Select Status --</option>
                    <option value="Excellent" {{ old('health_status') === 'Excellent' ? 'selected' : '' }}>Excellent</option>
                    <option value="Good" {{ old('health_status') === 'Good' ? 'selected' : '' }}>Good</option>
                    <option value="Fair" {{ old('health_status') === 'Fair' ? 'selected' : '' }}>Fair</option>
                    <option value="Poor" {{ old('health_status') === 'Poor' ? 'selected' : '' }}>Poor</option>
                </select>
                @error('health_status') <span style="color: #e74c3c;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea id="notes" name="notes" rows="4">{{ old('notes') }}</textarea>
            </div>

            <button type="submit" style="width: 100%;">Add Livestock</button>
        </form>
    </div>
</div>
@endsection
