@extends('layouts.admin-dashboard')

@section('title', 'Create Guide')
@section('page-title', 'Create New Farming Guide')
@section('page-subtitle', 'Add a new farming guide for farmers with optional video link')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <form method="POST" action="{{ route('admin.guides.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-heading text-emerald-600 mr-2"></i> Guide Title
                </label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600" placeholder="e.g., How to Plant Palay" required>
                @error('title')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-leaf text-green-600 mr-2"></i> Crop Type
                    </label>
                    <input type="text" name="crop_type" value="{{ old('crop_type') }}" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600" placeholder="Palay, Corn, Vegetables, Fruits, etc.">
                    @error('crop_type')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-calendar text-blue-600 mr-2"></i> Season
                    </label>
                    <select name="season" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600">
                        <option value="">Select Season (Optional)</option>
                        <option value="Wet Season" {{ old('season') == 'Wet Season' ? 'selected' : '' }}>Wet Season</option>
                        <option value="Dry Season" {{ old('season') == 'Dry Season' ? 'selected' : '' }}>Dry Season</option>
                        <option value="Year-Round" {{ old('season') == 'Year-Round' ? 'selected' : '' }}>Year-Round</option>
                    </select>
                    @error('season')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-tasks text-purple-600 mr-2"></i> Step-by-Step Guide
                </label>
                <textarea name="steps" rows="8" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600 font-mono text-sm" placeholder="Write detailed steps...&#10;Example:&#10;1. Prepare the soil&#10;2. Plant seeds&#10;3. Water regularly&#10;4. Apply fertilizer&#10;5. Harvest when ready" required>{{ old('steps') }}</textarea>
                @error('steps')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fab fa-youtube text-red-600 mr-2"></i> Video/Resource URL (Optional)
                </label>
                <input type="url" name="resource_url" value="{{ old('resource_url') }}" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600" placeholder="https://youtube.com/watch?v=... or any resource link">
                <p class="text-xs text-gray-600 mt-2">
                    <i class="fas fa-info-circle mr-1"></i> Leave blank if no video. Include full URL starting with http:// or https://
                </p>
                @error('resource_url')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-file-pdf text-red-700 mr-2"></i> Upload PDF Guide (Optional)
                </label>
                <input type="file" name="pdf_file" accept=".pdf" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600">
                <p class="text-xs text-gray-600 mt-2">
                    <i class="fas fa-info-circle mr-1"></i> Upload a PDF file for farmers to download. Maximum 10MB. PDF format only.
                </p>
                @error('pdf_file')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="flex gap-3 pt-6">
                <a href="{{ route('admin.guides.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 px-4 rounded-lg text-center font-semibold transition">
                    <i class="fas fa-arrow-left mr-2"></i> Cancel
                </a>
                <button type="submit" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white py-3 px-4 rounded-lg font-semibold transition">
                    <i class="fas fa-save mr-2"></i> Create Guide
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
