@extends('layouts.app')

@section('title', 'Market Prices')

@section('content')
<div class="card">
    <h2>📈 Market Prices</h2>
    <p>Track current market prices for agricultural products.</p>
</div>

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Crop</th>
                <th>Current Price</th>
                <th>Trend</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prices as $item)
                <tr>
                    <td>{{ $item['crop'] }}</td>
                    <td>{{ $item['price'] }}</td>
                    <td>
                        @if($item['trend'] === 'up')
                            <span style="color: green;">📈 Up</span>
                        @elseif($item['trend'] === 'down')
                            <span style="color: red;">📉 Down</span>
                        @else
                            <span style="color: #3498db;">➡️ Stable</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center; padding: 2rem;">No price data available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="card">
    <h2>Price Insights</h2>
    <p>Monitor price trends to make informed decisions about when to sell your crops.</p>
</div>
@endsection
