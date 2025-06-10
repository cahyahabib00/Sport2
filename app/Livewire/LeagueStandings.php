<?php
namespace App\Livewire;

use Livewire\Component;
use App\Services\SportsDbService;

class LeagueStandings extends Component
{
    public $leagueId;
    public $season = '2023-2024';
    public $standings = [];

    public function mount($leagueId)
    {
        $this->leagueId = $leagueId;
        $this->loadStandings();
    }

    public function loadStandings()
    {
        $service = new SportsDbService();
        $this->standings = $service->getStandings($this->leagueId, $this->season);
    }

    public function render()
    {
        return view('livewire.league-standings')
            ->layout('layout.app'); // menggunakan layout milikmu
    }
}
