<div class="max-w-7xl mx-auto">
    <!-- Loading Spinner -->
    <div wire:loading class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="animate-spin h-10 w-10 border-4 border-red-600 border-t-transparent rounded-full"></div>
    </div>

    <!-- Flash Message -->
    @if(session()->has('message'))
        <div class="bg-green-800 text-white p-4 rounded-lg mb-4 text-center">
            {{ session('message') }}
        </div>
    @endif

    <!-- Header -->
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8">Team Favorit</h2>

    <!-- Favorite Teams Grid -->
    @if($teams->isEmpty())
        <div class="bg-gray-900 p-6 rounded-lg shadow">
            <p class="text-gray-400 text-center">Belum ada team favorit. Tambahkan tim dari halaman detail tim.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($teams as $team)
                <div class="bg-gray-900 p-6 rounded-lg shadow transition duration-300 hover:bg-gray-800 hover:shadow-lg">
                    <img src="{{ $team->team_logo ?? 'https://via.placeholder.com/96?text=' . urlencode($team->team_name) }}" 
                         alt="{{ $team->team_name }}" 
                         class="h-24 w-24 mx-auto object-contain"
                         onerror="this.src='https://via.placeholder.com/96?text={{ urlencode($team->team_name) }}'">
                    <h3 class="text-lg font-bold text-white text-center mt-4">
                        <a href="/team/{{ $team->team_id }}" class="hover:text-red-600">{{ $team->team_name }}</a>
                    </h3>
                    <button wire:click="removeFavorite('{{ $team->team_id }}')" 
                            class="mt-4 px-4 py-2 bg-red-800 hover:bg-red-900 text-white rounded text-sm">
                        Hapus dari Favorit
                    </button>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Back Button -->
    <a href="/" class="mt-6 inline-block bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded transition duration-300">
        Kembali ke Daftar Liga
    </a>
</div>