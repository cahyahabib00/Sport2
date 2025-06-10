<div class="p-6">
    <h2 class="text-3xl font-bold text-white mb-6">Tim Favorit</h2>
    @if($favorites->isEmpty())
        <p class="text-gray-400">Belum ada tim favorit.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($favorites as $team)
                <div class="bg-gray-900 p-4 rounded-lg shadow">
                    <img src="{{ $team->logo_url }}" alt="{{ $team->team_name }}" class="h-24 mx-auto">
                    <h3 class="text-center text-white font-bold mt-2">{{ $team->team_name }}</h3>
                    <button wire:click="removeFavorite({{ $team->id }})" class="mt-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                        Hapus
                    </button>
                </div>
            @endforeach
        </div>
    @endif
</div>