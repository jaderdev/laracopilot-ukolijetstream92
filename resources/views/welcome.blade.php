<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MusicMS — Music Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        .gradient-hero { background: linear-gradient(135deg, #1e1b4b 0%, #312e81 40%, #4c1d95 100%); }
        .music-note { animation: float 3s ease-in-out infinite; }
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }
    </style>
</head>
<body class="bg-gray-50">

{{-- Navbar --}}
<nav class="gradient-hero sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
        <span class="text-white font-display font-bold text-2xl">🎵 MusicMS</span>
        <div class="flex items-center gap-3">
            @auth
                <a href="{{ route('dashboard') }}" class="text-purple-200 hover:text-white text-sm font-medium transition-colors">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-purple-200 hover:text-white text-sm font-medium transition-colors">Sign In</a>
                <a href="{{ route('register') }}" class="bg-white text-purple-700 px-4 py-2 rounded-full text-sm font-semibold hover:bg-purple-50 transition-colors">Get Started</a>
            @endauth
        </div>
    </div>
</nav>

{{-- Hero --}}
<section class="gradient-hero text-white py-24 px-4">
    <div class="max-w-4xl mx-auto text-center">
        <div class="music-note text-7xl mb-6">🎼</div>
        <h1 class="font-display font-bold text-5xl md:text-7xl mb-6 leading-tight">Music Management<br><span class="text-purple-300">Reimagined</span></h1>
        <p class="text-purple-200 text-xl md:text-2xl mb-10 max-w-2xl mx-auto leading-relaxed">A professional platform for composers to protect their work and singers to discover registered music.</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            @auth
                <a href="{{ route('dashboard') }}" class="w-full sm:w-auto bg-white text-purple-700 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-purple-50 transition-all shadow-xl hover:shadow-2xl">Go to Dashboard →</a>
            @else
                <a href="{{ route('register') }}" class="w-full sm:w-auto bg-white text-purple-700 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-purple-50 transition-all shadow-xl hover:shadow-2xl">Start for Free →</a>
                <a href="{{ route('login') }}" class="w-full sm:w-auto border-2 border-white text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white/10 transition-all">Sign In</a>
            @endauth
        </div>
    </div>
</section>

{{-- Features --}}
<section class="py-20 px-4 bg-white">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-14">
            <h2 class="font-display font-bold text-4xl text-gray-900 mb-4">Built for Music Professionals</h2>
            <p class="text-gray-500 text-lg">Everything you need to manage, protect, and discover music.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-purple-50 rounded-2xl p-8 text-center">
                <div class="text-5xl mb-4">🎼</div>
                <h3 class="font-display font-bold text-xl text-gray-900 mb-3">Composer Studio</h3>
                <p class="text-gray-600">Upload compositions with audio files, lyrics, and YouTube videos. Track ISRC registration status in real time.</p>
            </div>
            <div class="bg-indigo-50 rounded-2xl p-8 text-center">
                <div class="text-5xl mb-4">🎤</div>
                <h3 class="font-display font-bold text-xl text-gray-900 mb-3">Singer Catalog</h3>
                <p class="text-gray-600">Browse the registered music catalog. Stream audio, watch videos, and read lyrics — all in one place.</p>
            </div>
            <div class="bg-violet-50 rounded-2xl p-8 text-center">
                <div class="text-5xl mb-4">🛡️</div>
                <h3 class="font-display font-bold text-xl text-gray-900 mb-3">Legal Protection</h3>
                <p class="text-gray-600">Automated ISRC tracking and status badges keep your intellectual property protected and organized.</p>
            </div>
        </div>
    </div>
</section>

{{-- Demo Accounts --}}
<section class="py-20 px-4 bg-gray-50">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="font-display font-bold text-3xl text-gray-900 mb-3">Demo Accounts</h2>
            <p class="text-gray-500">Try the platform with these pre-configured accounts.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="text-3xl mb-3">🛡️</div>
                <h3 class="font-bold text-gray-900 mb-1">Admin</h3>
                <p class="text-sm text-gray-500 mb-3">Full system access</p>
                <div class="bg-gray-50 rounded-lg p-3 text-xs font-mono text-gray-600">
                    <p>admin@musicms.com</p>
                    <p class="text-gray-400">password</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="text-3xl mb-3">🎼</div>
                <h3 class="font-bold text-gray-900 mb-1">Composer</h3>
                <p class="text-sm text-gray-500 mb-3">Upload & manage compositions</p>
                <div class="bg-gray-50 rounded-lg p-3 text-xs font-mono text-gray-600">
                    <p>beethoven@musicms.com</p>
                    <p class="text-gray-400">password</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <div class="text-3xl mb-3">🎤</div>
                <h3 class="font-bold text-gray-900 mb-1">Singer</h3>
                <p class="text-sm text-gray-500 mb-3">Browse song catalog</p>
                <div class="bg-gray-50 rounded-lg p-3 text-xs font-mono text-gray-600">
                    <p>adele@musicms.com</p>
                    <p class="text-gray-400">password</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Footer --}}
<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
        <div class="md:col-span-2">
            <h4 class="font-display font-bold text-xl mb-3">🎵 MusicMS</h4>
            <p class="text-gray-400 text-sm leading-relaxed">A professional music management system built for composers and singers. Protect your work, discover new music.</p>
        </div>
        <div>
            <h5 class="font-semibold text-sm uppercase tracking-wider text-gray-400 mb-3">Platform</h5>
            <ul class="space-y-2 text-sm text-gray-500">
                <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Sign In</a></li>
                <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Register</a></li>
            </ul>
        </div>
        <div>
            <h5 class="font-semibold text-sm uppercase tracking-wider text-gray-400 mb-3">Legal</h5>
            <ul class="space-y-2 text-sm text-gray-500">
                <li><span>ISRC Standard</span></li>
                <li><span>Copyright Protection</span></li>
            </ul>
        </div>
    </div>
    <div class="border-t border-gray-800 py-6 text-center text-sm text-gray-500">
        <p>© {{ date('Y') }} MusicMS. All rights reserved.</p>
        <p class="mt-1">Made with ❤️ by <a href="https://laracopilot.com/" target="_blank" class="text-purple-400 hover:underline">LaraCopilot</a></p>
    </div>
</footer>
</body>
</html>
