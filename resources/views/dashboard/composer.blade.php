@extends('layouts.app')
@section('title', 'Composer Dashboard')

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-display font-bold text-gray-900">My Studio</h1>
            <p class="text-gray-500 mt-1">Welcome back, {{ auth()->user()->name }}. Manage your compositions below.</p>
        </div>
        <a href="{{ route('compositions.create') }}"
           class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-5 py-2.5 rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all shadow-md hover:shadow-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Upload New Composition
        </a>
    </div>

    {{-- KPI Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gradient-to-br from-purple-600 to-indigo-600 rounded-2xl p-6 text-white">
            <p class="text-purple-200 text-sm font-medium mb-1">Total Compositions</p>
            <p class="text-4xl font-bold">{{ $myTotal }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <p class="text-amber-500 text-sm font-medium mb-1">⏳ Pending Review</p>
            <p class="text-4xl font-bold text-gray-900">{{ $myPending }}</p>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <p class="text-green-500 text-sm font-medium mb-1">✅ Registered</p>
            <p class="text-4xl font-bold text-gray-900">{{ $myRegistered }}</p>
        </div>
    </div>

    {{-- My Compositions Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100">
        <div class="p-6 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-900">My Compositions</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">Title</th>
                        <th class="px-6 py-3 text-left">ISRC</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Uploaded</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($myCompositions as $composition)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <a href="{{ route('compositions.show', $composition) }}" class="font-semibold text-gray-900 hover:text-purple-600 transition-colors">{{ $composition->title }}</a>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 font-mono">{{ $composition->isrc }}</td>
                        <td class="px-6 py-4">
                            @if($composition->status === 'registered')
                                <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">✅ Registered</span>
                            @else
                                <span class="inline-flex items-center gap-1 bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-semibold">⏳ Pending</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-400">{{ $composition->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('compositions.show', $composition) }}" class="text-purple-600 hover:text-purple-800 text-sm font-medium">View</a>
                                <a href="{{ route('compositions.edit', $composition) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Edit</a>
                                <form action="{{ route('compositions.destroy', $composition) }}" method="POST" onsubmit="return confirm('Delete this composition?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <p class="text-5xl mb-3">🎼</p>
                            <p class="text-gray-500 font-medium">No compositions yet.</p>
                            <a href="{{ route('compositions.create') }}" class="text-purple-600 hover:underline text-sm mt-1 inline-block">Upload your first composition →</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
