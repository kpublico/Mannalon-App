@extends('layouts.admin-dashboard')

@section('title', 'Edit Announcement')
@section('page-title', 'Edit Announcement')
@section('page-subtitle', 'Update announcement details')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md p-8">
        <form method="POST" action="{{ route('admin.announcements.update', $id) }}">
            @csrf
            @method('PUT')
            
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Announcement Title</label>
                    <input type="text" name="title" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600" placeholder="Enter announcement title" value="{{ old('title', $announcement->title ?? '') }}" required>
                    @error('title')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Content</label>
                    <textarea name="content" rows="5" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600" placeholder="Enter announcement content" required>{{ old('content', $announcement->content ?? '') }}</textarea>
                    @error('content')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                    <select name="category" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600" required>
                        <option value="">Select a category</option>
                        <option value="General" {{ old('category', $announcement->category ?? '') == 'General' ? 'selected' : '' }}>General</option>
                        <option value="Alert" {{ old('category', $announcement->category ?? '') == 'Alert' ? 'selected' : '' }}>Alert</option>
                        <option value="Weather" {{ old('category', $announcement->category ?? '') == 'Weather' ? 'selected' : '' }}>Weather</option>
                    </select>
                    @error('category')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Target Audience</h3>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Audience Scope</label>
                        <select name="audience_scope" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600" id="audience_scope" required>
                            <option value="">Select audience scope</option>
                        <option value="all" {{ old('audience_scope', $announcement->audience_scope ?? 'all') == 'all' ? 'selected' : '' }}>All Farmers</option>
                            <option value="specific_group" {{ old('audience_scope', $announcement->audience_scope ?? '') == 'specific_group' ? 'selected' : '' }}>Specific Farmer Group</option>
                        </select>
                        @error('audience_scope')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <div id="target_group_container" class="mb-4" style="display: {{ in_array(old('audience_scope', $announcement->audience_scope ?? ''), ['specific_group']) ? 'block' : 'none' }}">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Target Group</label>
                        <select name="target_group_id" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600">
                            <option value="">Select a farmer group</option>
                            @forelse($groups as $group)
                                <option value="{{ $group->id }}" {{ old('target_group_id', $announcement->target_group_id ?? '') == $group->id ? 'selected' : '' }}>{{ $group->group_name }} ({{ $group->region ?? 'N/A' }}) </option>
                            @empty
                                <option value="">No farmer groups available</option>
                            @endforelse
                        </select>
                        @error('target_group_id')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Publishing Options</h3>
                    
                    <div class="mb-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_published" value="1" class="w-4 h-4" {{ old('is_published', $announcement->is_published ?? false) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm font-medium text-gray-700">Publish</span>
                        </label>
                        @error('is_published')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Start Date & Time</label>
                            <input type="datetime-local" name="starts_at" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600" value="{{ old('starts_at', $announcement->starts_at ? $announcement->starts_at->format('Y-m-d\TH:i') : '') }}">
                            @error('starts_at')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">End Date & Time</label>
                            <input type="datetime-local" name="ends_at" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600" value="{{ old('ends_at', $announcement->ends_at ? $announcement->ends_at->format('Y-m-d\TH:i') : '') }}">
                            @error('ends_at')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Expiry Date</label>
                        <input type="date" name="expiry_date" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:border-emerald-600" value="{{ old('expiry_date', $announcement->expiry_date ? $announcement->expiry_date->format('Y-m-d') : '') }}">
                        @error('expiry_date')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="flex gap-3 pt-6">
                    <button type="button" onclick="history.back()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 px-4 rounded-lg text-center font-semibold transition">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white py-3 px-4 rounded-lg font-semibold transition">
                        Update Announcement
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle audience scope toggle
    const audienceScope = document.getElementById('audience_scope');
    if (audienceScope) {
        audienceScope.addEventListener('change', function() {
            const targetGroupContainer = document.getElementById('target_group_container');
            if (this.value === 'specific_group') {
                targetGroupContainer.style.display = 'block';
            } else {
                targetGroupContainer.style.display = 'none';
            }
        });
    }
    
    // Handle form submission
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Log for debugging
            console.log('Form submitting to:', this.action);
        });
    }
});
</script>
@endsection
