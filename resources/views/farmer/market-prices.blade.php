@extends('layouts.farmer-dashboard')

@section('title', 'Market Prices')
@section('page-title', 'Market Prices')
@section('page-subtitle', 'Current market prices for agricultural products')

@section('content')
<div class="space-y-6">
    <form method="GET" action="{{ route('farmer.market-prices') }}" class="bg-white rounded-xl shadow-md p-6">
        <div class="flex flex-wrap gap-4 items-center">
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Search commodity..."
                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
            >
            <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
                <i class="fas fa-search mr-2"></i>Search
            </button>
        </div>
    </form>

    <div class="bg-white rounded-xl shadow-md p-6">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Commodity</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Price / Kilo</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Source Market</th>
                        <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Updated Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($prices as $price)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-semibold text-gray-800">{{ $price->commodity }}</td>
                            <td class="px-6 py-4 text-gray-800">PHP {{ number_format((float) $price->price_per_kilo, 2) }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $price->source_market ?: 'N/A' }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ optional($price->date_updated)->format('F d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-gray-600">No market prices found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-md p-4">
        {{ $prices->links() }}
    </div>
</div>
@endsection
