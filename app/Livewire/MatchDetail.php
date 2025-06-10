<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\SportsDbService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class MatchDetail extends Component
{
    public $eventId;
    public $match = [];

    public function mount($eventId, SportsDbService $service)
    {
        $this->eventId = $eventId;
        $this->match = $service->getMatchDetails($eventId);
        Log::info('Match Detail Data: ', $this->match);
    }

    public function render()
    {
        return view('livewire.match-detail')
            ->layout('layouts.app');
    }
}