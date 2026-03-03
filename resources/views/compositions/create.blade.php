@extends('layouts.app')
@section('title', 'Upload Composition')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('compositions.index') }}" class="hover:text-purple-600">Compositions</a>
            <span>/</span>
            <span>Upload New</span>
        </div>
        <h1 class="text-3xl font-display font-bold text-gray-900">Upload New Composition</h1>
        <p class="text-gray-500 mt-1">Fill in the details below and attach your audio file.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('compositions.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Composition Title <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('title') border-red-400 @enderror"
                       placeholder="Enter the composition title">
                @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- ISRC --}}
            <div>
                <label for="isrc" class="block text-sm font-semibold text-gray-700 mb-2">
                    ISRC Code <span class="text-red-500">*</span>
                    <span class="text-gray-400 font-normal text-xs ml-1">(International Standard Recording Code)</span>
                </label>
                <input type="text" id="isrc" name="isrc" value="{{ old('isrc') }}"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 font-mono uppercase focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('isrc') border-red-400 @enderror"
                       placeholder="e.g. USRC17607839">
                @error('isrc')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Audio File --}}
            <div>
                <label for="audio" class="block text-sm font-semibold text-gray-700 mb-2">Audio File <span class="text-red-500">*</span></label>
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-purple-400 transition-colors @error('audio') border-red-400 @enderror">
                    <input type="file" id="audio" name="audio" accept=".mp3,.wav,.ogg,.aac" class="hidden"
                           onchange="document.getElementById('audio-label').textContent = this.files[0]?.name || 'Click to select audio file'">
                    <label for="audio" class="cursor-pointer">
                        <div class="text-4xl mb-2">🎵</div>
                        <p id="audio-label" class="text-gray-500 text-sm">Click to select audio file</p>
                        <p class="text-gray-400 text-xs mt-1">MP3, WAV, OGG, AAC — max 50MB</p>
                    </label>
                </div>
                @error('audio')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Video URL --}}
            <div>
                <label for="video_url" class="block text-sm font-semibold text-gray-700 mb-2">
                    YouTube Video URL <span class="text-gray-400 font-normal text-xs ml-1">(optional)</span>
                </label>
                <input type="url" id="video_url" name="video_url" value="{{ old('video_url') }}"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('video_url') border-red-400 @enderror"
                       placeholder="https://www.youtube.com/watch?v=...">
                @error('video_url')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Lyrics --}}
            <div>
                <label for="lyrics" class="block text-sm font-semibold text-gray-700 mb-2">Lyrics <span class="text-red-500">*</span></label>
                <textarea id="lyrics" name="lyrics" rows="10"
                          class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all font-display @error('lyrics') border-red-400 @enderror"
                          placeholder="Enter the composition lyrics here...">{{ old('lyrics') }}</textarea>
                @error('lyrics')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Submit --}}
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('compositions.index') }}" class="px-6 py-2.5 text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors font-medium">Cancel</a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all shadow-md hover:shadow-lg">
                    Upload Composition
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
