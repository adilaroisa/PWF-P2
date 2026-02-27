<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
        
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-[#0a0a0a] text-white flex flex-col min-h-screen antialiased">
        
        <header class="w-full p-6 text-sm flex justify-end">
            @if (Route::has('login'))
                <nav class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="inline-block px-5 py-2 border border-[#3E3E3A] hover:border-gray-500 rounded-md transition text-gray-300 hover:text-white">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-block px-5 py-2 hover:bg-white/10 rounded-md transition text-gray-300 hover:text-white">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="inline-block px-5 py-2 border border-[#3E3E3A] hover:border-gray-500 rounded-md transition text-gray-300 hover:text-white">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>
        
        <main class="flex-grow flex items-center justify-center p-6 -mt-16">
            <div class="w-full max-w-4xl border border-[#3E3E3A] rounded-xl p-10 bg-[#161615] shadow-lg">
                
                <h1 class="text-white text-2xl font-semibold mb-1">
                    Adila Roisa Santosa
                </h1>

                <p class="text-gray-400 mb-6 font-bold">
                    20231040179
                </p>

                <button class="px-6 py-2 rounded-md bg-white text-black font-medium hover:bg-gray-200 transition">
                    Modul Pertemuan 2
                </button>

            </div>
        </main>

    </body>
</html>