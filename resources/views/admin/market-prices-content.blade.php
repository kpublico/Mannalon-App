<main>
<div class="space-y-6">
    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-lg">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4"><i class="fas fa-tags mr-2 text-emerald-600"></i>Current Commodity Tracker</h3>
        <form method="POST" action="{{ route('admin.market-prices.update') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            @csrf
            @method('PUT')
            <input type="text" name="commodity" placeholder="Commodity (Palay, Corn...)" class="px-4 py-2 border border-gray-300 rounded-lg" required>
            <input type="number" step="0.01" min="0" name="price_per_kilo" placeholder="Price per kilo" class="px-4 py-2 border border-gray-300 rounded-lg" required>
            <input type="date" name="date_updated" class="px-4 py-2 border border-gray-300 rounded-lg" required>
            <input type="text" name="source_market" placeholder="Source market" class="px-4 py-2 border border-gray-300 rounded-lg">
            <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 font-semibold">Save Price</button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900">Commodity Price List</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Commodity</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Price per Kilo</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Date Updated</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Source</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($prices as $price)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $price->commodity }}</td>
                            <td class="px-6 py-4 text-gray-900">PHP {{ number_format((float) $price->price_per_kilo, 2) }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $price->date_updated?->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $price->source_market ?? 'N/A' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <form method="POST" action="{{ route('admin.market-prices.row.update', $price) }}" class="flex gap-1">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="commodity" value="{{ $price->commodity }}">
                                        <input type="hidden" name="price_per_kilo" value="{{ $price->price_per_kilo }}">
                                        <input type="hidden" name="date_updated" value="{{ optional($price->date_updated)->format('Y-m-d') }}">
                                        <input type="hidden" name="source_market" value="{{ $price->source_market }}">
                                        <button class="px-3 py-1 text-xs bg-blue-600 text-white rounded">Keep</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.market-prices.row.destroy', $price) }}" onsubmit="return confirm('Delete this price row?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="px-3 py-1 text-xs bg-red-600 text-white rounded">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-6 py-8 text-center text-gray-500">No commodity prices yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</main>
