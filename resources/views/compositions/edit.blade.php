@extends('layouts.app')
@section('title', 'Edit: ' . $composition->title)

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="{{ route('compositions.index') }}" class="hover:text-purple-600">Compositions</a>
            <span>/</span>
            <a href="{{ route('compositions.show', $composition) }}" class="hover:text-purple-600">{{ $composition->title }}</a>
            <span>/</span>
            <span>Edit</span>
        </div>
        <h1 class="text-3xl font-display font-bold text-gray-900">Edit Composition</h1>
        <p class="text-gray-500 mt-1">Update the composition details below.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <form action="{{ route('compositions.update', $composition) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')

            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Composition Title <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $composition->title) }}"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('title') border-red-400 @enderror">
                @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- ISRC --}}
            <div>
                <label for="isrc" class="block text-sm font-semibold text-gray-700 mb-2">ISRC Code <span class="text-red-500">*</span></label>
                <input type="text" id="isrc" name="isrc" value="{{ old('isrc', $composition->isrc) }}"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 font-mono uppercase focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('isrc') border-red-400 @enderror">
                @error('isrc')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Current Audio --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Audio File</label>
                <div class="bg-purple-50 border border-purple-200 rounded-xl px-4 py-3 flex items-center gap-3 mb-3">
                    <span class="text-2xl">🎵</span>
                    <div>
                        <p class="text-sm font-medium text-purple-800">Current file: {{ basename($composition->audio_path) }}</p>
                        <p class="text-xs text-purple-500">Leave blank to keep current audio</p>
                    </div>
                </div>
                <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 text-center hover:border-purple-400 transition-colors">
                    <input type="file" id="audio" name="audio" accept=".mp3,.wav,.ogg,.aac" class="hidden"
                           onchange="document.getElementById('audio-label').textContent = this.files[0]?.name || 'Click to replace audio file'">
                    <label for="audio" class="cursor-pointer">
                        <p id="audio-label" class="text-gray-500 text-sm">Click to replace audio file (optional)</p>
                        <p class="text-gray-400 text-xs mt-1">MP3, WAV, OGG, AAC — max 50MB</p>
                    </label>
                </div>
                @error('audio')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Video URL --}}
            <div>
                <label for="video_url" class="block text-sm font-semibold text-gray-700 mb-2">YouTube Video URL <span class="text-gray-400 font-normal text-xs ml-1">(optional)</span></label>
                <input type="url" id="video_url" name="video_url" value="{{ old('video_url', $composition->video_url) }}"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('video_url') border-red-400 @enderror"
                       placeholder="https://www.youtube.com/watch?v=...">
                @error('video_url')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Lyrics --}}
            <div>
                <label for="lyrics" class="block text-sm font-semibold text-gray-700 mb-2">Lyrics <span class="text-red-500">*</span></label>
                <textarea id="lyrics" name="lyrics" rows="10"
                          class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all font-display @error('lyrics') border-red-400 @enderror">{{ old('lyrics', $composition->lyrics) }}</textarea>
                @error('lyrics')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Submit --}}
            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <a href="{{ route('compositions.show', $composition) }}" class="px-6 py-2.5 text-gray-600 border border-gray-300 rounded-xl hover:bg-gray-50 transition-colors font-medium">Cancel</a>
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all shadow-md hover:shadow-lg">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
