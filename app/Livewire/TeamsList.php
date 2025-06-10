<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\SportsDbService;
use Illuminate\Support\Facades\Log;

class TeamsList extends Component
{
    public $leagueId;
    public $teams = [];

    public function mount($leagueId, SportsDbService $service)
    {
        $this->leagueId = $leagueId;
        $this->teams = $service->getTeamsByLeague($leagueId);
        Log::info('Teams Count: ' . $this->teams->count());
        Log::info('Teams Data: ', $this->teams->toArray());
    }

    public function render()
    {
        return view('livewire.teams-list')
            ->layout('layouts.app');
    }
}