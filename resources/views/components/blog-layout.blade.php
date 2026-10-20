<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow">
        <div class="max-w-3xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('posts.index') }}" class="font-bold text-xl">My Blog</a>
            <div class="flex items-center gap-4 text-sm">
                @auth
                    <a href="{{ route('posts.create') }}" class="text-blue-600">Write post</a>
                    <span class="text-gray-600">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-red-600">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-blue-600">Login</a>
                    <a href="{{ route('register') }}" class="text-blue-600">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-3xl mx-auto px-4 py-8">
        @if (session('success'))
            <p class="mb-4 p-2 bg-green-100 text-green-700 rounded">{{ session('success') }}</p>
        @endif

        {{ $slot }}
    </main>
</body>
</html>