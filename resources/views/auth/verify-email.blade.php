<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify Email — MusicMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body{font-family:sans-serif;}</style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-900 via-purple-900 to-violet-900 flex items-center justify-center p-4">
<div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-8 text-center">
    <div class="text-5xl mb-4">📧</div>
    <h1 class="text-2xl font-bold text-gray-900 mb-3">Verify Your Email</h1>
    <p class="text-gray-500 text-sm mb-6">Thanks for signing up! Please verify your email address by clicking the link we just sent you.</p>
    @if(session('status') === 'verification-link-sent')
        <div class="mb-4 bg-green-50 text-green-700 text-sm px-4 py-3 rounded-xl border border-green-200">A new verification link has been sent to your email.</div>
    @endif
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 rounded-xl font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all text-sm mb-3">Resend Verification Email</button>
    </form>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="text-sm text-gray-500 hover:text-gray-700 underline">Sign Out</button>
    </form>
</div>
</body>
</html>
