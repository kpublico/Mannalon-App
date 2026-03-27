@extends('layouts.farmer-dashboard')

@section('title', 'Farming Guides & Video Tutorials')
@section('page-title', 'Farming Guides & Video Tutorials')
@section('page-subtitle', 'Master modern farming techniques through video tutorials and expert guides')

@section('content')
<div class="space-y-6">
    <form method="GET" action="{{ route('farmer.guides') }}" class="bg-white rounded-xl shadow-md p-6">
        <div class="flex flex-wrap gap-3">
            <input
                type="text"
                name="search"
                value="{{ $search }}"
                placeholder="Search guide title or steps..."
                class="flex-1 min-w-[200px] px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
            >
            <input
                type="text"
                name="crop_type"
                value="{{ $cropType }}"
                placeholder="Filter by crop type (e.g. Palay, Corn)"
                class="min-w-[200px] px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
            >
            <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-semibold">
                <i class="fas fa-search mr-2"></i>Search
            </button>
        </div>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse($guides as $guide)
            <article class="bg-white rounded-xl shadow-md border-t-4 border-emerald-500 overflow-hidden hover:shadow-lg transition flex flex-col">
                <div class="p-5 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">{{ $guide->title }}</h3>
                    <div class="mt-3 flex flex-wrap gap-2 text-xs">
                        <span class="px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 font-semibold">
                            <i class="fas fa-leaf mr-1"></i>{{ $guide->crop_type ?: 'General' }}
                        </span>
                        @if($guide->season)
                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-semibold">
                                <i class="fas fa-calendar mr-1"></i>{{ $guide->season }}
                            </span>
                        @endif
                        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 font-semibold">
                            <i class="fas fa-clock mr-1"></i>{{ $guide->created_at->format('M d, Y') }}
                        </span>
                    </div>
                </div>

                <div class="p-5 flex-1">
                    <p class="text-sm text-gray-700 whitespace-pre-line line-clamp-4 mb-4">{{ $guide->steps }}</p>
                </div>

                <div class="px-5 pb-5 border-t border-gray-100 flex gap-3 flex-wrap">
                    @if($guide->resource_url)
                        <a href="{{ $guide->resource_url }}" target="_blank" rel="noopener noreferrer" class="flex-1 min-w-[120px] px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold text-sm transition flex items-center justify-center gap-2">
                            <i class="fab fa-youtube"></i> Watch Video
                        </a>
                    @else
                        <div class="flex-1 min-w-[120px] px-4 py-2 bg-gray-300 text-gray-600 rounded-lg font-semibold text-sm flex items-center justify-center gap-2 cursor-not-allowed">
                            <i class="fas fa-ban"></i> No Video
                        </div>
                    @endif

                    @if($guide->pdf_file)
                        <a href="{{ asset('storage/' . $guide->pdf_file) }}" target="_blank" rel="noopener noreferrer" download class="flex-1 min-w-[120px] px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold text-sm transition flex items-center justify-center gap-2">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                    @else
                        <div class="flex-1 min-w-[120px] px-4 py-2 bg-gray-300 text-gray-600 rounded-lg font-semibold text-sm flex items-center justify-center gap-2 cursor-not-allowed">
                            <i class="fas fa-ban"></i> No PDF
                        </div>
                    @endif
                </div>
            </article>
        @empty
            <div class="md:col-span-2 xl:col-span-3 bg-white rounded-xl shadow-md p-8 text-center">
                <i class="fas fa-inbox text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-600 font-semibold">No farming guides found.</p>
                <p class="text-gray-500 text-sm mt-2">Try adjusting your search or crop type filter.</p>
            </div>
        @endforelse
    </div>

    <div class="bg-white rounded-xl shadow-md p-4">
        {{ $guides->links() }}
    </div>
</div>

@endsection
