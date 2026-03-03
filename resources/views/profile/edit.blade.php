@extends('layouts.app')
@section('title', 'My Profile')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div>
        <h1 class="text-3xl font-display font-bold text-gray-900">My Profile</h1>
        <p class="text-gray-500 mt-1">Manage your account information.</p>
    </div>

    {{-- Profile Info Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <h2 class="text-lg font-semibold text-gray-900 mb-6 pb-4 border-b border-gray-100">Profile Information</h2>
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
            @csrf @method('PATCH')

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('name') border-red-400 @enderror">
                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('email') border-red-400 @enderror">
                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Role badge (read-only) --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                <div class="flex items-center gap-2">
                    @foreach($user->getRoleNames() as $role)
                        <span class="inline-flex items-center gap-1.5 bg-purple-100 text-purple-700 px-4 py-2 rounded-full text-sm font-semibold capitalize">
                            @if($role === 'admin') 🛡️ @elseif($role === 'composer') 🎼 @else 🎤 @endif
                            {{ $role }}
                        </span>
                    @endforeach
                </div>
                <p class="text-xs text-gray-400 mt-1">Roles are assigned by the system administrator.</p>
            </div>

            <div class="flex items-center justify-end pt-4 border-t border-gray-100">
                <button type="submit" class="px-6 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all shadow-md text-sm">
                    Save Changes
                </button>
            </div>
        </form>
    </div>

    {{-- Delete Account Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-red-100 p-8">
        <h2 class="text-lg font-semibold text-red-600 mb-2">Delete Account</h2>
        <p class="text-gray-500 text-sm mb-6">Once your account is deleted, all compositions you own will also be removed. This action is irreversible.</p>
        <button onclick="document.getElementById('delete-modal').classList.remove('hidden')" class="px-5 py-2.5 bg-red-50 text-red-600 border border-red-200 rounded-xl font-semibold hover:bg-red-100 transition-colors text-sm">
            Delete My Account
        </button>
    </div>
</div>

{{-- Delete Modal --}}
<div id="delete-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full">
        <div class="text-center mb-6">
            <div class="text-5xl mb-3">⚠️</div>
            <h3 class="text-xl font-bold text-gray-900">Delete Account?</h3>
            <p class="text-gray-500 text-sm mt-2">This action cannot be undone. All your compositions will be permanently deleted.</p>
        </div>
        <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4">
            @csrf @method('DELETE')
            <div>
                <label for="delete-password" class="block text-sm font-semibold text-gray-700 mb-2">Confirm your password</label>
                <input id="delete-password" type="password" name="password" required
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent">
                @error('password', 'userDeletion')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="flex items-center gap-3">
                <button type="button" onclick="document.getElementById('delete-modal').classList.add('hidden')" class="flex-1 px-4 py-2.5 border border-gray-300 text-gray-700 rounded-xl font-medium hover:bg-gray-50 transition-colors text-sm">Cancel</button>
                <button type="submit" class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700 transition-colors text-sm">Yes, Delete</button>
            </div>
        </form>
    </div>
</div>
@endsection
