<?php

namespace App\Http\Controllers;

use App\Models\Composition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CompositionController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('composer') && !$user->hasRole('admin')) {
            $compositions = Composition::with('user')
                ->where('user_id', $user->id)
                ->latest()
                ->paginate(10);
        } else {
            $compositions = Composition::with('user')
                ->latest()
                ->paginate(10);
        }

        return view('compositions.index', compact('compositions'));
    }

    public function create()
    {
        $this->authorize('create', Composition::class);
        return view('compositions.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Composition::class);

        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'lyrics'    => 'required|string',
            'audio'     => 'required|file|mimes:mp3,wav,ogg,aac|max:51200',
            'video_url' => 'nullable|url|max:500',
            'isrc'      => 'required|string|max:50|unique:compositions,isrc',
        ]);

        $audioPath = $request->file('audio')->store('audio', 'public');

        Composition::create([
            'title'     => $validated['title'],
            'lyrics'    => $validated['lyrics'],
            'audio_path' => $audioPath,
            'video_url' => $validated['video_url'] ?? null,
            'isrc'      => strtoupper($validated['isrc']),
            'status'    => 'pending',
            'user_id'   => Auth::id(),
        ]);

        return redirect()->route('compositions.index')
            ->with('success', 'Composition uploaded successfully and is pending review.');
    }

    public function show(Composition $composition)
    {
        $this->authorize('view', $composition);
        $composition->load('user');
        return view('compositions.show', compact('composition'));
    }

    public function edit(Composition $composition)
    {
        $this->authorize('update', $composition);
        return view('compositions.edit', compact('composition'));
    }

    public function update(Request $request, Composition $composition)
    {
        $this->authorize('update', $composition);

        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'lyrics'    => 'required|string',
            'audio'     => 'nullable|file|mimes:mp3,wav,ogg,aac|max:51200',
            'video_url' => 'nullable|url|max:500',
            'isrc'      => 'required|string|max:50|unique:compositions,isrc,' . $composition->id,
        ]);

        $data = [
            'title'     => $validated['title'],
            'lyrics'    => $validated['lyrics'],
            'video_url' => $validated['video_url'] ?? null,
            'isrc'      => strtoupper($validated['isrc']),
        ];

        if ($request->hasFile('audio')) {
            // Delete old audio
            Storage::disk('public')->delete($composition->audio_path);
            $data['audio_path'] = $request->file('audio')->store('audio', 'public');
        }

        $composition->update($data);

        return redirect()->route('compositions.show', $composition)
            ->with('success', 'Composition updated successfully.');
    }

    public function destroy(Composition $composition)
    {
        $this->authorize('delete', $composition);

        Storage::disk('public')->delete($composition->audio_path);
        $composition->delete();

        return redirect()->route('compositions.index')
            ->with('success', 'Composition deleted successfully.');
    }

    public function updateStatus(Request $request, Composition $composition)
    {
        $this->authorize('updateStatus', $composition);

        $request->validate([
            'status' => 'required|in:pending,registered',
        ]);

        $composition->update(['status' => $request->status]);

        return back()->with('success', 'Status updated to ' . ucfirst($request->status) . '.');
    }
}