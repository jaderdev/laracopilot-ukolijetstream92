@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-display font-bold text-gray-900">Admin Dashboard</h1>
            <p class="text-gray-500 mt-1">Welcome back, {{ auth()->user()->name }}. Here's the system overview.</p>
        </div>
        <span class="inline-flex items-center gap-2 bg-indigo-100 text-indigo-700 px-4 py-2 rounded-full text-sm font-semibold">
            🛡️ Administrator
        </span>
    </div>

    {{-- KPI Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
                </div>
                <span class="text-xs text-gray-400 font-medium">Total</span>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $totalCompositions }}</p>
            <p class="text-gray-500 text-sm mt-1">All Compositions</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <span class="text-xs text-amber-500 font-medium">Pending</span>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $pendingCount }}</p>
            <p class="text-gray-500 text-sm mt-1">Awaiting Review</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <span class="text-xs text-green-500 font-medium">Registered</span>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $registeredCount }}</p>
            <p class="text-gray-500 text-sm mt-1">Officially Registered</p>
        </div>
    </div>

    {{-- Recent Compositions --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900">Recent Compositions</h2>
            <a href="{{ route('compositions.index') }}" class="text-purple-600 text-sm font-medium hover:underline">View all →</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($recentCompositions as $composition)
            <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-indigo-400 rounded-xl flex items-center justify-center text-white text-lg">
                        🎵
                    </div>
                    <div>
                        <a href="{{ route('compositions.show', $composition) }}" class="font-semibold text-gray-900 hover:text-purple-600 transition-colors">{{ $composition->title }}</a>
                        <p class="text-sm text-gray-500">by {{ $composition->user->name }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-xs text-gray-400">ISRC: {{ $composition->isrc }}</span>
                    @if($composition->status === 'registered')
                        <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">✅ Registered</span>
                    @else
                        <span class="inline-flex items-center gap-1 bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-semibold">⏳ Pending</span>
                    @endif
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-gray-400">
                <p class="text-4xl mb-2">🎶</p>
                <p>No compositions yet.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
