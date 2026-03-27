@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="card">
    <h2>Welcome to Mannalon App! 🌾</h2>
    <p>Your comprehensive farming management system. Monitor your crops, livestock, weather conditions, and market prices all in one place.</p>
</div>

<div class="stats-grid">
    <div class="stat-box">
        <h3>{{ $totalCrops }}</h3>
        <p>Total Crops</p>
    </div>
    <div class="stat-box">
        <h3>{{ $activeLivestock }}</h3>
        <p>Active Livestock</p>
    </div>
    <div class="stat-box">
        <h3>{{ $harvestReady }}</h3>
        <p>Ready to Harvest</p>
    </div>
    <div class="stat-box">
        <h3>{{ $weatherAlert ? '⚠️' : '✓' }}</h3>
        <p>{{ $weatherAlert ? 'Weather Alert' : 'Weather Good' }}</p>
    </div>
</div>

<div class="card">
    <h2>Quick Actions</h2>
    <p>
        <a href="{{ route('crops.index') }}" style="color: #2ecc71; text-decoration: none; font-weight: bold;">→ Manage Crops</a><br><br>
        <a href="{{ route('livestock.index') }}" style="color: #2ecc71; text-decoration: none; font-weight: bold;">→ Manage Livestock</a><br><br>
        <a href="{{ route('weather.index') }}" style="color: #2ecc71; text-decoration: none; font-weight: bold;">→ Check Weather</a><br><br>
        <a href="{{ route('market-prices.index') }}" style="color: #2ecc71; text-decoration: none; font-weight: bold;">→ View Market Prices</a>
    </p>
</div>

<div class="card">
    <h2>Recent Activity</h2>
    <p>No recent activity yet. Start by managing your crops and livestock!</p>
</div>
@endsection
