@extends('layouts.app')

@section('title', 'Monitor Livestock')

@section('content')
<div class="card">
    <h2>🐄 Livestock Monitoring</h2>
    <p>Monitor all livestock from all farmers</p>
</div>

<div class="card">
    @if($livestock->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Farmer</th>
                    <th>Count</th>
                    <th>Health Status</th>
                    <th>Last Checkup</th>
                </tr>
            </thead>
            <tbody>
                @foreach($livestock as $animal)
                    <tr>
                        <td>{{ $animal->type }}</td>
                        <td>{{ $animal->user->name }}</td>
                        <td>{{ $animal->count }}</td>
                        <td>{{ $animal->health_status }}</td>
                        <td>{{ $animal->last_checkup ? $animal->last_checkup->format('M d, Y') : 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 1rem;">
            {{ $livestock->links() }}
        </div>
    @else
        <p style="text-align: center; padding: 2rem;">No livestock found</p>
    @endif
</div>
@endsection
