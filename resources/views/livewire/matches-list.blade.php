<div class="max-w-7xl mx-auto">
    <!-- Loading Spinner -->
    <div wire:loading class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="animate-spin h-10 w-10 border-4 border-red-600 border-t-transparent rounded-full"></div>
    </div>

    <!-- Header -->
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Jadwal Pertandingan Sebelumnya</h2>

    <!-- Standings Button -->
    <div class="mb-6">
        <a href="/league/{{ $leagueId }}/standings" 
           class="inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded transition duration-300">
            Lihat Klasemen Sementara
        </a>
    </div>

    <!-- Matches Grid -->
    @if($matches->isEmpty())
        <div class="bg-gray-900 p-6 rounded-lg shadow">
            <p class="text-gray-400 text-center">Tidak ada pertandingan ditemukan untuk liga ini.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($matches as $match)
                <a href="/match/{{ $match['idEvent'] }}" 
                   class="bg-gray-900 p-6 rounded-lg shadow transition duration-300 hover:bg-gray-800 hover:shadow-lg">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-white">{{ $match['strHomeTeam'] }} vs {{ $match['strAwayTeam'] }}</h3>
                            <p class="text-gray-400 text-sm">
                                {{ \Carbon\Carbon::parse($match['dateEvent'] . ' ' . $match['strTime'])->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                            </p>
                            <p class="text-gray-400 text-sm">Venue: {{ $match['strVenue'] }}</p>
                        </div>
                        <div class="text-white text-lg font-bold">
                            {{ $match['intHomeScore'] }} - {{ $match['intAwayScore'] }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>