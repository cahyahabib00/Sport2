<div class="max-w-7xl mx-auto">
    <!-- Loading Spinner -->
    <div wire:loading class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="animate-spin h-10 w-10 border-4 border-red-600 border-t-transparent rounded-full"></div>
    </div>

    <!-- Header -->
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8">Daftar Tim - {{ $leagueName }}</h2>

    <!-- Teams Grid -->
    @if($teams->isEmpty())
        <div class="bg-gray-900 p-6 rounded-lg shadow">
            <p class="text-gray-400 text-center">Tidak ada tim ditemukan untuk liga ini. Coba liga lain atau periksa koneksi API.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($teams as $team)
                <a href="/team/{{ $team['idTeam'] }}" 
                   class="bg-gray-900 p-6 rounded-lg shadow transition duration-300 hover:bg-gray-800 hover:shadow-lg">
                    <img src="{{ $team['strTeamBadge'] ?? 'https://via.placeholder.com/96?text=' . urlencode($team['strTeam']) }}" 
                         alt="{{ $team['strTeam'] }}" 
                         class="h-24 w-24 mx-auto object-contain"
                         onerror="this.src='https://via.placeholder.com/96?text={{ urlencode($team['strTeam']) }}'"
                         loading="lazy">
                    <h3 class="text-lg font-bold text-white text-center mt-4 hover:text-red-600">{{ $team['strTeam'] }}</h3>
                    @if(app()->environment('local') && empty($team['strTeamBadge']))
                        <p class="text-red-400 text-xs text-center mt-2">No valid badge URL</p>
                    @endif
                </a>
            @endforeach
        </div>
    @endif

    <!-- Navigation Buttons -->
    <div class="mt-6 flex flex-wrap gap-4">
        <a href="/league/{{ $leagueId }}/matches" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded transition duration-300">
            Lihat Pertandingan
        </a>
        <a href="/league/{{ $leagueId }}/standings" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded transition duration-300">
            Lihat Klasemen
        </a>
        <a href="/" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded transition duration-300">
            Kembali ke Daftar Liga
        </a>
    </div>
</div>