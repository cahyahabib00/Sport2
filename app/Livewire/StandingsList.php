<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\SportsDbService;
use Illuminate\Support\Facades\Log;

class StandingsList extends Component
{
    public $leagueId;
    public $standings = [];
    public $season = '2023-2024';

    public function mount($leagueId, SportsDbService $service)
    {
        $this->leagueId = $leagueId;
        $this->standings = $service->getStandings($leagueId, $this->season);
        Log::info('Standings Count: ' . $this->standings->count());
        Log::info('Standings Data: ', $this->standings->toArray());
    }

    public function render()
    {
        return view('livewire.standings-list')
            ->layout('layouts.app');
    }
}