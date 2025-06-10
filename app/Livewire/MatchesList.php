<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\SportsDbService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class MatchesList extends Component
{
    public $leagueId;
    public $matches = [];

    public function mount($leagueId, SportsDbService $service)
    {
        $this->leagueId = $leagueId;
        $this->matches = $service->getPastMatches($leagueId);
        Log::info('Matches Count: ' . $this->matches->count());
        Log::info('Matches Data: ', $this->matches->toArray());
    }

    public function render()
    {
        return view('livewire.matches-list')
            ->layout('layouts.app');
    }
}