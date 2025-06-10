<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soccer App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body 
    class="bg-cover bg-center text-white font-sans"
    style="background-image: url('https://cdn.pixabay.com/photo/2018/05/15/23/02/football-stadium-3404535_1280.jpg');">

    {{-- Navbar --}}
    <nav class="sticky top-0 bg-gray-900 shadow-md z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-3xl font-bold text-red-600">Soccer App</a>
            <ul class="hidden md:flex space-x-6 text-sm font-semibold text-gray-300">
                <li><a href="#">Liga Terkini</a></li>
                <li><a href="#">Team</a></li>
                <li><a href="/favorites">Team Favorit</a></li>
                <li><a href="#">Klasement</a></li>
                <li><a href="#">Pertandingan</a></li>
                {{-- <li><a href="#">NCAAW</a></li> --}}
            </ul>
            <div class="text-white">
                <i class="fas fa-user-circle text-xl"></i>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="px-6 py-12 max-w-7xl mx-auto">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
