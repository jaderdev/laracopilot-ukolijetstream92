@extends('layouts.app')
@section('title', 'Singer Dashboard')

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div>
        <h1 class="text-3xl font-display font-bold text-gray-900">Song Catalog</h1>
        <p class="text-gray-500 mt-1">Welcome back, {{ auth()->user()->name }}. Explore the registered song catalog.</p>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gradient-to-br from-purple-600 to-indigo-600 rounded-2xl p-6 text-white">
            <p class="text-purple-200 text-sm font-medium mb-1">Available Songs</p>
            <p class="text-4xl font-bold">{{ $catalog->count() }}</p>
            <p class="text-purple-300 text-sm mt-1">Registered & ready to perform</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <p class="text-gray-500 text-sm font-medium mb-1">Total Library</p>
            <p class="text-4xl font-bold text-gray-900">{{ $genreCount }}</p>
            <p class="text-gray-400 text-sm mt-1">Songs in the system</p>
        </div>
    </div>

    {{-- Catalog Grid --}}
    <div>
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Registered Songs</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @forelse($catalog as $composition)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 group">
                <div class="bg-gradient-to-br from-purple-500 to-indigo-600 rounded-t-2xl p-6 flex items-center justify-center">
                    <span class="text-5xl">🎵</span>
                </div>
                <div class="p-5">
                    <div class="flex items-start justify-between gap-2 mb-2">
                        <a href="{{ route('compositions.show', $composition) }}" class="font-semibold text-gray-900 hover:text-purple-600 transition-colors group-hover:text-purple-600 line-clamp-2">{{ $composition->title }}</a>
                        <span class="inline-flex items-center bg-green-100 text-green-700 px-2 py-0.5 rounded-full text-xs font-semibold flex-shrink-0">✅ Reg.</span>
                    </div>
                    <p class="text-sm text-gray-500 mb-3">🎼 {{ $composition->user->name }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-400 font-mono">{{ $composition->isrc }}</span>
                        <a href="{{ route('compositions.show', $composition) }}" class="text-sm text-purple-600 font-medium hover:underline">Listen →</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 py-16 text-center">
                <p class="text-6xl mb-4">🎶</p>
                <p class="text-gray-500 text-lg font-medium">No registered songs available yet.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
