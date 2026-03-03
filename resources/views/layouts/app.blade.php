<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MusicMS') — MusicMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        .nav-dropdown:focus-within .nav-dropdown-menu { display: block; }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen bg-gray-50 flex flex-col">

    {{-- ===== TOP NAVIGATION BAR ===== --}}
    <nav class="bg-gradient-to-r from-indigo-900 via-purple-900 to-violet-900 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                {{-- Logo --}}
                <div class="flex items-center gap-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <span class="text-2xl">🎵</span>
                        <span class="font-display font-bold text-white text-xl group-hover:text-purple-300 transition-colors">MusicMS</span>
                    </a>

                    {{-- Primary Nav Links --}}
                    <div class="hidden md:flex items-center gap-1">
                        <a href="{{ route('dashboard') }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-all
                                  {{ request()->routeIs('dashboard') ? 'bg-white/20 text-white' : 'text-purple-200 hover:bg-white/10 hover:text-white' }}">
                            🏠 Dashboard
                        </a>

                        @auth
                            @if(auth()->user()->hasRole('composer') || auth()->user()->hasRole('admin'))
                                <a href="{{ route('compositions.index') }}"
                                   class="px-3 py-2 rounded-lg text-sm font-medium transition-all
                                          {{ request()->routeIs('compositions.*') ? 'bg-white/20 text-white' : 'text-purple-200 hover:bg-white/10 hover:text-white' }}">
                                    🎼 My Compositions
                                </a>
                                <a href="{{ route('compositions.create') }}"
                                   class="px-3 py-2 rounded-lg text-sm font-medium transition-all
                                          {{ request()->routeIs('compositions.create') ? 'bg-white/20 text-white' : 'text-purple-200 hover:bg-white/10 hover:text-white' }}">
                                    ➕ Upload
                                </a>
                            @endif

                            @if(auth()->user()->hasRole('singer'))
                                <a href="{{ route('compositions.index') }}"
                                   class="px-3 py-2 rounded-lg text-sm font-medium transition-all
                                          {{ request()->routeIs('compositions.*') ? 'bg-white/20 text-white' : 'text-purple-200 hover:bg-white/10 hover:text-white' }}">
                                    🎵 Browse Catalog
                                </a>
                            @endif

                            @if(auth()->user()->hasRole('admin'))
                                <a href="{{ route('admin.users.index') }}"
                                   class="px-3 py-2 rounded-lg text-sm font-medium transition-all
                                          {{ request()->routeIs('admin.*') ? 'bg-white/20 text-white' : 'text-purple-200 hover:bg-white/10 hover:text-white' }}">
                                    🛡️ Admin
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>

                {{-- Right Side --}}
                <div class="flex items-center gap-3">
                    @auth
                        {{-- Role Badge --}}
                        <div class="hidden sm:block">
                            @foreach(auth()->user()->getRoleNames() as $role)
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold
                                    @if($role === 'admin') bg-yellow-400/20 text-yellow-300 border border-yellow-400/30
                                    @elseif($role === 'composer') bg-blue-400/20 text-blue-300 border border-blue-400/30
                                    @else bg-green-400/20 text-green-300 border border-green-400/30
                                    @endif">
                                    @if($role === 'admin') 🛡️
                                    @elseif($role === 'composer') 🎼
                                    @else 🎤
                                    @endif
                                    {{ ucfirst($role) }}
                                </span>
                            @endforeach
                        </div>

                        {{-- User Dropdown --}}
                        <div class="relative nav-dropdown" x-data="{ open: false }">
                            <button
                                onclick="this.nextElementSibling.classList.toggle('hidden')"
                                class="flex items-center gap-2 bg-white/10 hover:bg-white/20 border border-white/20 text-white px-3 py-2 rounded-xl transition-all text-sm font-medium">
                                {{-- Avatar initials --}}
                                <span class="w-7 h-7 rounded-full bg-gradient-to-br from-purple-400 to-indigo-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                                <span class="hidden sm:block max-w-[120px] truncate">{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            {{-- Dropdown Menu --}}
                            <div class="hidden absolute right-0 mt-2 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50"
                                 id="user-dropdown">

                                {{-- User Info Header --}}
                                <div class="px-4 py-3 border-b border-gray-100">
                                    <p class="text-sm font-semibold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate mt-0.5">{{ auth()->user()->email }}</p>
                                </div>

                                {{-- Menu Items --}}
                                <div class="py-1">
                                    <a href="{{ route('profile.edit') }}"
                                       class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors">
                                        <span class="text-base">👤</span>
                                        <span>My Profile</span>
                                    </a>

                                    <a href="{{ route('dashboard') }}"
                                       class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors">
                                        <span class="text-base">🏠</span>
                                        <span>Dashboard</span>
                                    </a>

                                    @if(auth()->user()->hasRole('composer') || auth()->user()->hasRole('admin'))
                                        <a href="{{ route('compositions.create') }}"
                                           class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-700 transition-colors">
                                            <span class="text-base">🎵</span>
                                            <span>Upload Composition</span>
                                        </a>
                                    @endif
                                </div>

                                {{-- Logout --}}
                                <div class="border-t border-gray-100 pt-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                                class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors text-left">
                                            <span class="text-base">🚪</span>
                                            <span>Sign Out</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Guest buttons --}}
                        <a href="{{ route('login') }}" class="text-purple-200 hover:text-white text-sm font-medium transition-colors px-3 py-2">
                            Sign In
                        </a>
                        <a href="{{ route('register') }}" class="bg-white text-purple-900 hover:bg-purple-50 px-4 py-2 rounded-xl text-sm font-semibold transition-all shadow-md">
                            Register
                        </a>
                    @endauth

                    {{-- Mobile menu button --}}
                    <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                            class="md:hidden p-2 rounded-lg text-purple-200 hover:text-white hover:bg-white/10 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden md:hidden border-t border-white/10">
            <div class="px-4 py-3 space-y-1">
                @auth
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-purple-200 hover:bg-white/10 hover:text-white transition-all">🏠 Dashboard</a>
                    <a href="{{ route('compositions.index') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-purple-200 hover:bg-white/10 hover:text-white transition-all">🎵 Compositions</a>
                    <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-purple-200 hover:bg-white/10 hover:text-white transition-all">👤 My Profile</a>
                    <form method="POST" action="{{ route('logout') }}" class="pt-2 border-t border-white/10 mt-2">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-sm font-medium text-red-300 hover:bg-white/10 hover:text-red-200 transition-all">🚪 Sign Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-purple-200 hover:bg-white/10 hover:text-white transition-all">Sign In</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-purple-200 hover:bg-white/10 hover:text-white transition-all">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Flash Messages --}}
    @if(session('success') || session('error') || session('status'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 w-full">
            @if(session('success'))
                <div class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl text-sm shadow-sm">
                    <span class="text-lg">✅</span>
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-green-400 hover:text-green-600">✕</button>
                </div>
            @endif
            @if(session('error'))
                <div class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl text-sm shadow-sm">
                    <span class="text-lg">❌</span>
                    <span>{{ session('error') }}</span>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-red-400 hover:text-red-600">✕</button>
                </div>
            @endif
            @if(session('status'))
                <div class="flex items-center gap-3 bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-xl text-sm shadow-sm">
                    <span class="text-lg">ℹ️</span>
                    <span>{{ session('status') }}</span>
                    <button onclick="this.parentElement.remove()" class="ml-auto text-blue-400 hover:text-blue-600">✕</button>
                </div>
            @endif
        </div>
    @endif

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="flex-1 max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="bg-gray-900 text-white mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="md:col-span-2">
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-2xl">🎵</span>
                    <span class="font-display font-bold text-white text-xl">MusicMS</span>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">A professional music management platform connecting composers and singers. Upload, discover, and license original compositions with ease.</p>
            </div>
            <div>
                <h4 class="text-white font-semibold text-sm mb-3 uppercase tracking-wider">Platform</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ route('dashboard') }}" class="hover:text-white transition-colors">Dashboard</a></li>
                    <li><a href="{{ route('compositions.index') }}" class="hover:text-white transition-colors">Compositions</a></li>
                    @guest
                        <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Sign In</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Register</a></li>
                    @endguest
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold text-sm mb-3 uppercase tracking-wider">Account</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    @auth
                        <li><a href="{{ route('profile.edit') }}" class="hover:text-white transition-colors">My Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-400 hover:text-white transition-colors">Sign Out</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Sign In</a></li>
                    @endauth
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 py-5 text-center text-sm text-gray-500">
            <p>© {{ date('Y') }} MusicMS. All rights reserved.</p>
            <p class="mt-1">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="hover:text-gray-300 transition-colors underline">LaraCopilot</a></p>
        </div>
    </footer>

    {{-- Close dropdown when clicking outside --}}
    <script>
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('user-dropdown');
            const btn = dropdown ? dropdown.previousElementSibling : null;
            if (dropdown && btn && !btn.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
