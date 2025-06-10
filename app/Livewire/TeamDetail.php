<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\SportsDbService;
use App\Models\FavoriteTeam;
use Illuminate\Support\Facades\Log;

class TeamDetail extends Component
{
    public $teamId;
    public $team = [];
    public $isFavorite = false;

    public function mount($teamId, SportsDbService $service)
    {
        $this->teamId = $teamId;
        $this->team = $service->getTeamDetails($teamId);
        $this->isFavorite();
        Log::info('Team Detail Data: ', $this->team);
    }

    protected function isFavorite()
    {
        $this->isFavorite = FavoriteTeam::where('team_id', $this->teamId)->exists();
    }

    public function toggleFavorite()
    {
        if ($this->isFavorite) {
            FavoriteTeam::where('team_id', $this->teamId)->delete();
            $this->isFavorite = false;
            session()->flash('message', 'Tim dihapus dari favorit.');
        } else {
            FavoriteTeam::create([
                'team_id' => $this->team['idTeam'],
                'team_name' => $this->team['strTeam'],
                'team_logo' => $this->team['strTeamBadge'],
            ]);
            $this->isFavorite = true;
            session()->flash('message', 'Tim ditambahkan ke favorit!');
        }
    }

    public function render()
    {
        return view('livewire.team-detail')
            ->layout('layouts.app');
    }
}