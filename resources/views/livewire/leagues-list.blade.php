<div class="max-w-7xl mx-auto">
    <div wire:loading class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
        <div class="animate-spin h-10 w-10 border-4 border-red-600 border-t-transparent rounded-full"></div>
    </div>
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-8">Daftar Liga</h2>

    @if($leagues->isEmpty())
        <div class="bg-gray-900 p-6 rounded-lg shadow">
            <p class="text-gray-400 text-center">Tidak ada Pertandingan Sepak Bola ditemukan. Coba lagi nanti.</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($leagues as $league)
    <div class="bg-gray-900 p-6 rounded-lg shadow transition duration-300 hover:bg-gray-800 hover:shadow-lg">
        <img 
            src="{{ 
                isset($league['strBadge']) && !empty($league['strBadge']) 
                    ? str_replace('http://', 'https://', $league['strBadge']) 
                    : 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/60/Soccer_ball.svg/96px-Soccer_ball.svg.png' 
            }}" 
            alt="{{ $league['strLeague'] }}" 
            class="h-24 w-24 mx-auto object-contain"
            onerror="this.onerror=null;this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/60/Soccer_ball.svg/96px-Soccer_ball.svg.png';"
        >
        <h3 class="text-lg font-bold text-white text-center mt-4">{{ $league['strLeague'] }}</h3>
        <div class="mt-4 flex flex-wrap justify-center gap-4">
            <a href="/league/{{ $league['idLeague'] }}/matches" 
               class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm">
                Pertandingan
            </a>
            <a href="/league/{{ $league['idLeague'] }}/standings" 
               class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm">
                Klasemen
            </a>
            <a href="/league/{{ $league['idLeague'] }}/teams" 
               class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded text-sm">
                Tim
            </a>
        </div>
    </div>
@endforeach

        </div>
    @endif
</div>
