@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="card">
    <h2>👤 My Profile</h2>
</div>

<div style="max-width: 600px; margin: 0 auto;">
    <div class="card">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" required>
                @error('name') <span style="color: #e74c3c;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" required>
                @error('email') <span style="color: #e74c3c;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" value="{{ $user->phone ?? '' }}">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea id="address" name="address" rows="3">{{ $user->address ?? '' }}</textarea>
            </div>

            <div class="form-group">
                <label>Role</label>
                <input type="text" value="{{ ucfirst($user->role) }}" disabled>
            </div>

            <div class="form-group">
                <label>Member Since</label>
                <input type="text" value="{{ $user->created_at->format('M d, Y') }}" disabled>
            </div>

            <button type="submit" style="width: 100%;">Update Profile</button>
        </form>
    </div>
</div>
@endsection
