<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm Password — MusicMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body{font-family:sans-serif;}</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-violet-900 flex items-center justify-center p-4">
<div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8">
    <div class="text-center mb-6">
        <div class="text-4xl mb-3">🔒</div>
        <h1 class="text-2xl font-bold text-gray-900">Confirm Password</h1>
        <p class="text-gray-500 text-sm mt-1">Please confirm your password before continuing.</p>
    </div>
    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
        @csrf
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('password') border-red-400 @enderror">
            @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all shadow-md text-sm">Confirm</button>
    </form>
</div>
</body>
</html>
