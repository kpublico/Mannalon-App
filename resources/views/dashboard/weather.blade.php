@extends('layouts.app')

@section('title', 'Weather Information')

@section('content')
<div class="card">
    <h2>🌤️ Weather Information</h2>
    <p>Current weather conditions and forecast for your farming area.</p>
</div>

<div class="stats-grid">
    <div class="stat-box">
        <h3>{{ $temperature }}°C</h3>
        <p>Temperature</p>
    </div>
    <div class="stat-box">
        <h3>{{ $humidity }}%</h3>
        <p>Humidity</p>
    </div>
    <div class="stat-box">
        <h3>{{ $rainfall }}mm</h3>
        <p>Rainfall</p>
    </div>
    <div class="stat-box">
        <h3>{{ $windSpeed }}km/h</h3>
        <p>Wind Speed</p>
    </div>
</div>

<div class="card">
    <h2>Forecast</h2>
    <p><strong>{{ $forecast }}</strong></p>
    <p>This is a sample forecast. Integrate with a weather API for real-time data.</p>
</div>

<div class="card">
    <h2>Weather Alerts</h2>
    <p>No active weather alerts for your area.</p>
</div>
@endsection
