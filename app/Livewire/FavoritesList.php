<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\FavoriteTeam;

class FavoritesList extends Component
{
    public $favorites;

    public function mount()
    {
        $this->favorites = FavoriteTeam::all();
    }

    public function removeFavorite($id)
    {
        FavoriteTeam::destroy($id);
        $this->favorites = FavoriteTeam::all();
    }

    public function render()
    {
        return view('livewire.favorites-list');
    }
}
