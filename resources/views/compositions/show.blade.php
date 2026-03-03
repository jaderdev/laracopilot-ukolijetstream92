@extends('layouts.app')
@section('title', $composition->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    {{-- Header --}}
    <div class="flex items-start justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
                <a href="{{ route('compositions.index') }}" class="hover:text-purple-600 transition-colors">Compositions</a>
                <span>/</span>
                <span class="text-gray-900 font-medium">{{ $composition->title }}</span>
            </div>
            <h1 class="text-3xl font-display font-bold text-gray-900">{{ $composition->title }}</h1>
            <p class="text-gray-500 mt-1">Composed by <span class="font-medium text-gray-700">{{ $composition->user->name }}</span></p>
        </div>

        <div class="flex items-center gap-2 flex-shrink-0">
            @can('update', $composition)
                <a href="{{ route('compositions.edit', $composition) }}"
                   class="inline-flex items-center gap-1.5 bg-indigo-50 text-indigo-600 border border-indigo-200 px-4 py-2 rounded-xl text-sm font-medium hover:bg-indigo-100 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit
                </a>
            @endcan
            @can('delete', $composition)
                <form action="{{ route('compositions.destroy', $composition) }}" method="POST" onsubmit="return confirm('Delete this composition permanently?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-1.5 bg-red-50 text-red-600 border border-red-200 px-4 py-2 rounded-xl text-sm font-medium hover:bg-red-100 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Delete
                    </button>
                </form>
            @endcan
        </div>
    </div>

    {{-- Legal Status & Metadata Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Legal Information</h2>
        <div class="flex flex-wrap items-center gap-4">
            {{-- Status Badge --}}
            @if($composition->status === 'registered')
                <div class="flex items-center gap-3 bg-green-50 border border-green-200 rounded-xl px-4 py-3">
                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-green-600 font-medium">Legal Status</p>
                        <p class="text-sm font-bold text-green-800">✅ Officially Registered</p>
                    </div>
                </div>
            @else
                <div class="flex items-center gap-3 bg-amber-50 border border-amber-200 rounded-xl px-4 py-3">
                    <div class="w-8 h-8 bg-amber-100 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-amber-600 font-medium">Legal Status</p>
                        <p class="text-sm font-bold text-amber-800">⏳ Pending Registration</p>
                    </div>
                </div>
            @endif

            {{-- ISRC Badge --}}
            <div class="flex items-center gap-3 bg-purple-50 border border-purple-200 rounded-xl px-4 py-3">
                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                </div>
                <div>
                    <p class="text-xs text-purple-600 font-medium">ISRC Code</p>
                    <p class="text-sm font-bold text-purple-800 font-mono">{{ $composition->isrc }}</p>
                </div>
            </div>

            {{-- Date Badge --}}
            <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl px-4 py-3">
                <div class="w-8 h-8 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="text-xs text-gray-500 font-medium">Uploaded</p>
                    <p class="text-sm font-bold text-gray-700">{{ $composition->created_at->format('F j, Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Admin Status Toggle --}}
        @role('admin')
        <div class="mt-4 pt-4 border-t border-gray-100">
            <p class="text-sm font-semibold text-gray-500 mb-3">Admin: Update Registration Status</p>
            <form action="{{ route('compositions.updateStatus', $composition) }}" method="POST" class="flex items-center gap-3">
                @csrf @method('PATCH')
                <select name="status" class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    <option value="pending" {{ $composition->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="registered" {{ $composition->status === 'registered' ? 'selected' : '' }}>Registered</option>
                </select>
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-purple-700 transition-colors">Update Status</button>
            </form>
        </div>
        @endrole
    </div>

    {{-- HTML5 Audio Player --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <div>
                <h2 class="font-semibold text-gray-900">Audio Playback</h2>
                <p class="text-sm text-gray-500">{{ $composition->title }}</p>
            </div>
        </div>
        <audio controls class="w-full audio-player rounded-xl" style="height:54px;">
            <source src="{{ Storage::url($composition->audio_path) }}" type="audio/mpeg">
            <source src="{{ Storage::url($composition->audio_path) }}" type="audio/wav">
            Your browser does not support the HTML5 audio element.
        </audio>
        <p class="text-xs text-gray-400 mt-2 text-center">Use the controls above to play, pause, and adjust volume.</p>
    </div>

    {{-- YouTube Video Player --}}
    @if($composition->video_url && $composition->getYouTubeEmbedUrl())
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24"><path d="M23.495 6.205a3.007 3.007 0 00-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 00.527 6.205a31.247 31.247 0 00-.522 5.805 31.247 31.247 0 00.522 5.783 3.007 3.007 0 002.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 002.088-2.088 31.247 31.247 0 00.5-5.783 31.247 31.247 0 00-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
            </div>
            <div>
                <h2 class="font-semibold text-gray-900">Video</h2>
                <p class="text-sm text-gray-500">Official music video</p>
            </div>
        </div>
        <div class="relative w-full" style="padding-bottom: 56.25%;">
            <iframe
                class="absolute top-0 left-0 w-full h-full rounded-xl"
                src="{{ $composition->getYouTubeEmbedUrl() }}"
                title="{{ $composition->title }} - Video"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>
            </iframe>
        </div>
    </div>
    @elseif($composition->video_url)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h2 class="font-semibold text-gray-900 mb-2">External Video</h2>
        <a href="{{ $composition->video_url }}" target="_blank" rel="noopener noreferrer" class="text-purple-600 hover:underline break-all">{{ $composition->video_url }}</a>
    </div>
    @endif

    {{-- Lyrics --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <h2 class="font-semibold text-gray-900">Lyrics</h2>
        </div>
        <div class="lyrics-container rounded-xl p-6 md:p-8">
            <p class="text-gray-800 whitespace-pre-line text-base md:text-lg leading-loose">{{ $composition->lyrics }}</p>
        </div>
    </div>
</div>
@endsection
