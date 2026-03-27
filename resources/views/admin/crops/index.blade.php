@extends('layouts.app')

@section('title', 'Monitor Crops')

@section('content')
<div class="card">
    <h2>🌾 Crops Monitoring</h2>
    <p>Monitor all crops from all farmers</p>
</div>

<div class="card">
    @if($crops->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Crop Name</th>
                    <th>Farmer</th>
                    <th>Area</th>
                    <th>Status</th>
                    <th>Planting Date</th>
                    <th>Expected Harvest</th>
                </tr>
            </thead>
            <tbody>
                @foreach($crops as $crop)
                    <tr>
                        <td>{{ $crop->name }}</td>
                        <td>{{ $crop->user->name }}</td>
                        <td>{{ $crop->area }}</td>
                        <td>{{ $crop->status }}</td>
                        <td>{{ $crop->planting_date->format('M d, Y') }}</td>
                        <td>{{ $crop->expected_harvest_date->format('M d, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 1rem;">
            {{ $crops->links() }}
        </div>
    @else
        <p style="text-align: center; padding: 2rem;">No crops found</p>
    @endif
</div>
@endsection
