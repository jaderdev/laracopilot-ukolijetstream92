<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register — MusicMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>body{font-family:'Inter',sans-serif;} .font-display{font-family:'Playfair Display',serif;}</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-violet-900 flex items-center justify-center p-4">
<div class="w-full max-w-md">
    <div class="text-center mb-8">
        <a href="/" class="inline-block">
            <span class="text-5xl">🎵</span>
            <h1 class="font-display font-bold text-white text-3xl mt-2">MusicMS</h1>
        </a>
        <p class="text-purple-300 mt-1 text-sm">Create your account</p>
    </div>

    <div class="bg-white rounded-3xl shadow-2xl p-8">
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('name') border-red-400 bg-red-50 @enderror">
                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('email') border-red-400 bg-red-50 @enderror">
                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Role Selection --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">I am a... <span class="text-red-500">*</span></label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="composer" class="sr-only peer" {{ old('role') === 'composer' ? 'checked' : '' }}>
                        <div class="border-2 border-gray-200 rounded-xl p-4 text-center peer-checked:border-purple-500 peer-checked:bg-purple-50 transition-all hover:border-purple-300">
                            <div class="text-3xl mb-1">🎼</div>
                            <p class="font-semibold text-sm text-gray-800">Composer</p>
                            <p class="text-xs text-gray-500 mt-0.5">Upload compositions</p>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="role" value="singer" class="sr-only peer" {{ old('role') === 'singer' ? 'checked' : '' }}>
                        <div class="border-2 border-gray-200 rounded-xl p-4 text-center peer-checked:border-purple-500 peer-checked:bg-purple-50 transition-all hover:border-purple-300">
                            <div class="text-3xl mb-1">🎤</div>
                            <p class="font-semibold text-sm text-gray-800">Singer</p>
                            <p class="text-xs text-gray-500 mt-0.5">Browse catalog</p>
                        </div>
                    </label>
                </div>
                @error('role')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all @error('password') border-red-400 bg-red-50 @enderror">
                @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all">
            </div>

            <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all shadow-md hover:shadow-lg text-sm">
                Create Account
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Already have an account?
            <a href="{{ route('login') }}" class="text-purple-600 font-semibold hover:underline">Sign in</a>
        </p>
    </div>
</div>
</body>
</html>
