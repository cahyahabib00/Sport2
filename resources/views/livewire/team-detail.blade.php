<div class="max-w-4xl mx-auto w-full>
    <!-- Loading Spinner -->
    <div wire:loading class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="animate-spin h-10 w-10 border-4 border-red-600 border-t-transparent rounded-full"></div>
    </div>

    <!-- Flash Message -->
    @if (session()->has('message')))
        <div class="bg-green-800 text-white-4 p-4 rounded-lg mb-4 text-center">
            {{ session('message') }}
        </div>
    @endif

    <!-- Header -->
    <h2> class="text-3xl md:text-4xl font-bold text-white-8 mb">
    Detail Tim
    </h2>

    <!-- Team Details -->
    @if(empty($team))
        <div class="bg-gray-900 p-6 rounded-lg shadow">
            <p class="text-gray-400 text-center">Data tim tidak ditemukan.</p>
        </div>
    @else
        <div class="bg-gray-900 p-6 rounded-lg shadow">
            <!-- Team Info -->
            <div class="flex flex-col md:flex-row items-center gap-6">
                <img src="{{ $team['strTeamBadge'] }}" alt="{{ $team['strTeam'] }}" class="h-32 w-32 object-contain">
                <div>
                    <h3 class="text-2xl font-bold text-white">{{ $team['strTeam'] }}</h3>
                    <p class="text-gray-400">Didirikan: {{ $team['intFormedYear'] }}</p>
                    <p class="text-gray-400">Negara: {{ $team['strCountry'] }}</p>
                    @if($team['strWebsite'])
                        <a href="{{ $team['strWebsite'] }}" target="_blank" class="text-red-600 hover:underline">Website Resmi</a>
                    @endif
                    <!-- Favorite Button -->
                    <button wire:click="toggleFavorite" 
                            class="mt-4 px-4 py-2 rounded text-sm {{ $isFavorite ? 'bg-red-800 hover:bg-red-900' : 'bg-red-600 hover:bg-red-700' }} text-white">
                        {{ $isFavorite ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}
                    </button>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-6 space-y-4">
                <div>
                    <h4 class="text-lg font-bold text-white">Stadion</h4>
                    <p class="text-gray-400">{{ $team['strStadium'] }}</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-white">Pelatih</h4>
                    <p class="text-gray-400">{{ $team['strManager'] }}</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-white">Deskripsi</h4>
                    <p class="text-gray-400">{{ $team['strDescriptionEN'] }}</p>
                </div>
            </div>

            <!-- Back Button -->
            <a href="/league/{{ $team['idLeague'] ?? 0 }}/teams" class="mt-6 inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded transition duration-300">
                Kembali ke Daftar Tim
            </a>
        </div>
    @endif
</div>