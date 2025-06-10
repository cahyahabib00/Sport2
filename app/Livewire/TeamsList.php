<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\SportsDbService;
use Illuminate\Support\Facades\Log;

class TeamsList extends Component
{
    public $leagueId;
    public $leagueName;
    public $teams = [];

    public function mount($leagueId, SportsDbService $service)
    {
        $this->leagueId = $leagueId;
        // Dapatkan nama liga untuk header
        $leagueResponse = $service->getSoccerLeagues()->firstWhere('idLeague', $leagueId);
        $this->leagueName = $leagueResponse['strLeague'] ?? 'Unknown League';
        $this->teams = $service->getTeamsByLeague($leagueId);
        Log::info('Teams Count for League ID ' . $leagueId . ': ' . $this->teams->count());
        Log::info('Teams Data: ', $this->teams->toArray());
    }

    public function render()
    {
        return view('livewire.teams-list')
            ->layout('layouts.app');
    }
}