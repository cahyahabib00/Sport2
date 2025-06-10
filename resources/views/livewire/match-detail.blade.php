<div class="max-w-4xl mx-auto">
    <!-- Loading Spinner -->
    <div wire:loading class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="animate-spin h-10 w-10 border-4 border-red-600 border-t-transparent rounded-full"></div>
    </div>

    <!-- Header -->
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8">Detail Pertandingan</h2>

    <!-- Match Details -->
    @if(empty($match))
        <div class="bg-gray-900 p-6 rounded-lg shadow">
            <p class="text-gray-400 text-center">Data pertandingan tidak ditemukan.</p>
        </div>
    @else
        <div class="bg-gray-900 p-6 rounded-lg shadow">
            <!-- Teams and Score -->
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-4">
                    <img src="{{ $match['strHomeTeamBadge'] }}" alt="{{ $match['strHomeTeam'] }}" class="h-20 w-20 object-contain">
                    <h3 class="text-xl font-bold text-white">{{ $match['strHomeTeam'] }}</h3>
                </div>
                <div class="text-2xl font-bold text-white">
                    {{ $match['intHomeScore'] }} - {{ $match['intAwayScore'] }}
                </div>
                <div class="flex items-center gap-4">
                    <h3 class="text-xl font-bold text-white">{{ $match['strAwayTeam'] }}</h3>
                    <img src="{{ $match['strAwayTeamBadge'] }}" alt="{{ $match['strAwayTeam'] }}" class="h-20 w-20 object-contain">
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-6 space-y-2">
                <p class="text-gray-400">Liga: {{ $match['strLeague'] }}</p>
                <p class="text-gray-400">Musim: {{ $match['strSeason'] }}</p>
                <p class="text-gray-400">Tanggal: {{ \Carbon\Carbon::parse($match['dateEvent'] . ' ' . $match['strTime'])->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB</p>
                <p class="text-gray-400">Venue: {{ $match['strVenue'] }}</p>
                <p class="text-gray-400">Status: {{ $match['strStatus'] }}</p>
            </div>

            <!-- Back Button -->
            <a href="/league/{{ $match['idLeague'] ?? 4331 }}/matches" class="mt-6 inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded transition duration-300">
                Kembali ke Daftar Pertandingan
            </a>
        </div>
    @endif
</div>