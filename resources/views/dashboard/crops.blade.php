@extends('layouts.app')

@section('title', 'Crops Management')

@section('content')
<div class="card">
    <h2>🌾 My Crops</h2>
    <p>Manage and monitor all your crops</p>
</div>

<div class="card">
    <a href="{{ route('crops.create') }}" style="display: inline-block; background-color: #2ecc71; color: white; padding: 0.75rem 1.5rem; border-radius: 4px; text-decoration: none; margin-bottom: 1rem;">+ Add New Crop</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($crops->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Crop Name</th>
                    <th>Area</th>
                    <th>Status</th>
                    <th>Planting Date</th>
                    <th>Expected Harvest</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($crops as $crop)
                    <tr>
                        <td>{{ $crop->name }}</td>
                        <td>{{ $crop->area }}</td>
                        <td>{{ $crop->status }}</td>
                        <td>{{ $crop->planting_date->format('M d, Y') }}</td>
                        <td>{{ $crop->expected_harvest_date->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('crops.edit', $crop->id) }}" style="color: #3498db; text-decoration: none;">Edit</a> |
                            <form method="POST" action="{{ route('crops.destroy', $crop->id) }}" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" style="background: transparent; color: #e74c3c; border: none; cursor: pointer; text-decoration: underline;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align: center; padding: 2rem;">No crops added yet. <a href="{{ route('crops.create') }}" style="color: #2ecc71;">Add your first crop</a></p>
    @endif
</div>
@endsection
