<?php


namespace App\Livewire;

use Livewire\Component;
use App\Services\SportsDbService;
use Illuminate\Support\Facades\Log;

class LeaguesList extends Component
{
    public $leagues = [];

    public function mount(SportsDbService $service)
    {
        $this->leagues = $service->getSoccerLeagues();
    }

    public function render()
    {
        return view('livewire.leagues-list')
            ->layout('layouts.app');
    }
}