<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MusicMS') }} - @yield('title', 'Music Management')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        .sidebar-link.active { background: linear-gradient(135deg, #7c3aed, #4f46e5); color: white; }
        .sidebar-link:not(.active):hover { background: rgba(124,58,237,0.08); color: #7c3aed; }
        .glass { background: rgba(255,255,255,0.08); backdrop-filter: blur(12px); }
        .gradient-bg { background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4c1d95 100%); }
        .lyrics-container {
            background: linear-gradient(135deg, #faf5ff, #ede9fe);
            border-left: 4px solid #7c3aed;
            font-family: 'Playfair Display', serif;
            line-height: 2;
            letter-spacing: 0.01em;
        }
        .audio-player::-webkit-media-controls-panel { background-color: #ede9fe; }
        #mobile-menu { display: none; }
        #mobile-menu.open { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-8px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeIn 0.25s ease; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

{{-- Mobile top bar --}}
<div class="gradient-bg lg:hidden flex items-center justify-between px-4 py-3 sticky top-0 z-50">
    <a href="{{ route('dashboard') }}" class="text-white font-display font-bold text-xl">🎵 MusicMS</a>
    <button onclick="document.getElementById('mobile-menu').classList.toggle('open')" class="text-white focus:outline-none">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>
</div>

<div class="flex min-h-screen">
    {{-- Sidebar --}}
    <aside id="mobile-menu" class="gradient-bg w-64 min-h-screen flex-shrink-0 lg:flex flex-col fixed lg:static top-0 left-0 z-40 lg:z-auto h-full lg:h-auto fade-in">
        <div class="p-6 border-b border-white/10 hidden lg:block">
            <a href="{{ route('dashboard') }}" class="text-white font-display font-bold text-2xl block">🎵 MusicMS</a>
            <p class="text-purple-300 text-xs mt-1">Music Management System</p>
        </div>

        {{-- User info --}}
        <div class="px-4 py-4 border-b border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-400 to-indigo-400 flex items-center justify-center text-white font-bold text-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-white font-semibold text-sm truncate">{{ auth()->user()->name }}</p>
                    <p class="text-purple-300 text-xs capitalize">
                        @foreach(auth()->user()->getRoleNames() as $role)
                            <span class="inline-flex items-center gap-1">
                                @if($role === 'admin') 🛡️ @elseif($role === 'composer') 🎼 @else 🎤 @endif
                                {{ $role }}
                            </span>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-4 space-y-1">
            <a href="{{ route('dashboard') }}"
               class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }} flex items-center gap-3 px-4 py-2.5 rounded-xl text-purple-100 text-sm font-medium transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <a href="{{ route('compositions.index') }}"
               class="sidebar-link {{ request()->routeIs('compositions.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-2.5 rounded-xl text-purple-100 text-sm font-medium transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
                Compositions
            </a>

            @role('composer|admin')
            <a href="{{ route('compositions.create') }}"
               class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-purple-100 text-sm font-medium transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Upload Composition
            </a>
            @endrole

            <a href="{{ route('profile.edit') }}"
               class="sidebar-link {{ request()->routeIs('profile.*') ? 'active' : '' }} flex items-center gap-3 px-4 py-2.5 rounded-xl text-purple-100 text-sm font-medium transition-all duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                My Profile
            </a>
        </nav>

        {{-- Logout --}}
        <div class="px-3 py-4 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-purple-200 text-sm font-medium transition-all duration-200 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    {{-- Main content --}}
    <main class="flex-1 min-w-0 p-4 lg:p-8">
        {{-- Flash messages --}}
        @if(session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl flex items-center gap-2 fade-in">
                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center gap-2 fade-in">
                <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>
</div>

{{-- Close mobile menu on outside click --}}
<script>
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('mobile-menu');
        const btn = e.target.closest('button');
        if (!btn && menu && menu.classList.contains('open') && !menu.contains(e.target)) {
            menu.classList.remove('open');
        }
    });
</script>
</body>
</html>
