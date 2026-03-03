@extends('layouts.app')
@section('title', 'Compositions')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-display font-bold text-gray-900">Compositions</h1>
            <p class="text-gray-500 mt-1">{{ $compositions->total() }} composition(s) found</p>
        </div>
        @role('composer|admin')
        <a href="{{ route('compositions.create') }}"
           class="inline-flex items-center gap-2 bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-5 py-2.5 rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all shadow-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Upload Composition
        </a>
        @endrole
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4 text-left">Title</th>
                        <th class="px-6 py-4 text-left">Composer</th>
                        <th class="px-6 py-4 text-left">ISRC</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-left">Media</th>
                        <th class="px-6 py-4 text-left">Date</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($compositions as $composition)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <a href="{{ route('compositions.show', $composition) }}" class="font-semibold text-gray-900 hover:text-purple-600 transition-colors">{{ $composition->title }}</a>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $composition->user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500 font-mono">{{ $composition->isrc }}</td>
                        <td class="px-6 py-4">
                            @if($composition->status === 'registered')
                                <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">✅ Registered</span>
                            @else
                                <span class="inline-flex items-center gap-1 bg-amber-100 text-amber-700 px-3 py-1 rounded-full text-xs font-semibold">⏳ Pending</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <span class="text-purple-500 text-lg" title="Audio">🎵</span>
                                @if($composition->video_url)
                                    <span class="text-red-500 text-lg" title="Video">▶️</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-400">{{ $composition->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('compositions.show', $composition) }}" class="text-purple-600 hover:text-purple-800 text-sm font-medium">View</a>
                                @can('update', $composition)
                                    <a href="{{ route('compositions.edit', $composition) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Edit</a>
                                @endcan
                                @can('delete', $composition)
                                    <form action="{{ route('compositions.destroy', $composition) }}" method="POST" onsubmit="return confirm('Delete this composition?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">Delete</button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center">
                            <p class="text-5xl mb-3">🎶</p>
                            <p class="text-gray-500 font-medium">No compositions found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $compositions->links() }}
        </div>
    </div>
</div>
@endsection
