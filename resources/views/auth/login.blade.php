<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In — MusicMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>body{font-family:'Inter',sans-serif;} .font-display{font-family:'Playfair Display',serif;}</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-violet-900 flex items-center justify-center p-4">
<div class="w-full max-w-md">
    {{-- Logo --}}
    <div class="text-center mb-8">
        <a href="/" class="inline-block">
            <span class="text-5xl">🎵</span>
            <h1 class="font-display font-bold text-white text-3xl mt-2">MusicMS</h1>
        </a>
        <p class="text-purple-300 mt-1 text-sm">Sign in to your account</p>
    </div>

    {{-- Demo credentials --}}
    <div class="bg-white/10 backdrop-blur rounded-2xl p-4 mb-6 border border-white/20">
        <p class="text-white text-xs font-semibold uppercase tracking-wider mb-3">🔑 Demo Accounts</p>
        <div class="grid grid-cols-3 gap-2 text-xs">
            <div class="bg-white/10 rounded-lg p-2 text-center">
                <p class="text-purple-200 font-semibold">🛡️ Admin</p>
                <p class="text-white/70 mt-0.5 break-all">admin@musicms.com</p>
            </div>
            <div class="bg-white/10 rounded-lg p-2 text-center">
                <p class="text-purple-200 font-semibold">🎼 Composer</p>
                <p class="text-white/70 mt-0.5 break-all">beethoven@musicms.com</p>
            </div>
            <div class="bg-white/10 rounded-lg p-2 text-center">
                <p class="text-purple-200 font-semibold">🎤 Singer</p>
                <p class="text-white/70 mt-0.5 break-all">adele@musicms.com</p>
            </div>
        </div>
        <p class="text-white/50 text-xs text-center mt-2">All passwords: <span class="font-mono text-white/80">password</span></p>
    </div>

    {{-- Card --}}
    <div class="bg-white rounded-3xl shadow-2xl p-8">
        @if(session('status'))
            <div class="mb-4 bg-green-50 text-green-700 text-sm px-4 py-3 rounded-xl border border-green-200">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('email') border-red-400 bg-red-50 @enderror">
                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <div class="flex items-center justify-between mb-2">
                    <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-purple-600 text-xs hover:underline">Forgot password?</a>
                    @endif
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('password') border-red-400 bg-red-50 @enderror">
                @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center gap-2">
                <input id="remember" type="checkbox" name="remember" class="rounded border-gray-300 text-purple-600 focus:ring-purple-500">
                <label for="remember" class="text-sm text-gray-600">Remember me</label>
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all shadow-md hover:shadow-lg text-sm">
                Sign In
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-purple-600 font-semibold hover:underline">Register</a>
        </p>
    </div>
</div>
</body>
</html>
