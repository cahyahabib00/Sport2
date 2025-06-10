<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\FavoriteTeam;
use Illuminate\Support\Facades\Log;

class FavoriteTeamsList extends Component
{
    public $teams = [];

    public function mount()
    {
        $this->loadFavorites();
    }

    public function removeFavorite($teamId)
    {
        FavoriteTeam::where('team_id', $teamId)->delete();
        $this->loadFavorites();
        session()->flash('message', 'Tim dihapus dari favorit.');
    }

    protected function loadFavorites()
    {
        $this->teams = FavoriteTeam::all();
        Log::info('Favorite Teams Count: ' . $this->teams->count());
        Log::info('Favorite Teams Data: ', $this->teams->toArray());
    }

    public function render()
    {
        return view('livewire.favorite-teams-list')
            ->layout('layouts.app');
    }
}