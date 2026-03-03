<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password — MusicMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body{font-family:'Inter',sans-serif;}</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-violet-900 flex items-center justify-center p-4">
<div class="w-full max-w-md">
    <div class="text-center mb-8">
        <a href="/"><span class="text-5xl">🎵</span></a>
        <h1 class="text-white font-bold text-2xl mt-2">Forgot your password?</h1>
        <p class="text-purple-300 text-sm mt-1">Enter your email and we'll send a reset link.</p>
    </div>
    <div class="bg-white rounded-3xl shadow-2xl p-8">
        @if(session('status'))
            <div class="mb-4 bg-green-50 text-green-700 text-sm px-4 py-3 rounded-xl border border-green-200">{{ session('status') }}</div>
        @endif
        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('email') border-red-400 @enderror">
                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all shadow-md text-sm">Send Reset Link</button>
        </form>
        <p class="text-center text-sm text-gray-500 mt-6">
            <a href="{{ route('login') }}" class="text-purple-600 font-semibold hover:underline">← Back to Sign In</a>
        </p>
    </div>
</div>
</body>
</html>
