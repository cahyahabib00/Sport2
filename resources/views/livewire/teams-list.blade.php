<div class="max-w-7xl mx-auto">
    <!-- Loading Spinner -->
    <div wire:loading class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="animate-spin h-10 w-10 border-4 border-red-600 border-t-transparent rounded-full"></div>
    </div>

    <!-- Header -->
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8">Daftar Tim</h2>

    <!-- Teams Grid -->
    @if($teams->isEmpty())
        <div class="bg-gray-900 p-6 rounded-lg shadow">
            <p class="text-gray-400 text-center">Tidak ada tim ditemukan untuk liga ini.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($teams as $team)
                <a href="/team/{{ $team['idTeam'] }}" 
                   class="bg-gray-900 p-6 rounded-lg shadow transition duration-300 hover:bg-gray-800 hover:shadow-lg">
                    <img src="{{ $team['strTeamBadge'] }}" 
                         alt="{{ $team['strTeam'] }}" 
                         class="h-24 w-24 mx-auto object-contain">
                    <h3 class="text-lg font-bold text-white text-center mt-4 hover:text-red-600">{{ $team['strTeam'] }}</h3>
                </a>
            @endforeach
        </div>
    @endif

    <!-- Back Button -->
    <a href="/league/{{ $leagueId }}/matches" class="mt-6 inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded transition duration-300">
        Kembali ke Daftar Pertandingan
    </a>
</div>