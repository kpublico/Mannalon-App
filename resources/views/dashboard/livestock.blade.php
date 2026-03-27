@extends('layouts.app')

@section('title', 'Livestock Management')

@section('content')
<div class="card">
    <h2>🐄 My Livestock</h2>
    <p>Manage and monitor all your livestock</p>
</div>

<div class="card">
    <a href="{{ route('livestock.create') }}" style="display: inline-block; background-color: #2ecc71; color: white; padding: 0.75rem 1.5rem; border-radius: 4px; text-decoration: none; margin-bottom: 1rem;">+ Add Livestock</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($livestock->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Count</th>
                    <th>Health Status</th>
                    <th>Last Checkup</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($livestock as $animal)
                    <tr>
                        <td>{{ $animal->type }}</td>
                        <td>{{ $animal->count }}</td>
                        <td><span style="background-color: #d4edda; color: #155724; padding: 0.5rem;">{{ $animal->health_status }}</span></td>
                        <td>{{ $animal->last_checkup ? $animal->last_checkup->format('M d, Y') : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('livestock.edit', $animal->id) }}" style="color: #3498db; text-decoration: none;">Edit</a> |
                            <form method="POST" action="{{ route('livestock.destroy', $animal->id) }}" style="display: inline;">
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
        <p style="text-align: center; padding: 2rem;">No livestock added yet. <a href="{{ route('livestock.create') }}" style="color: #2ecc71;">Add your first livestock</a></p>
    @endif
</div>
@endsection
