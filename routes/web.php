<?php

use App\Livewire\TeamsList;
use App\Livewire\TeamDetail;
use App\Livewire\LeaguesList;
// use App\Http\Livewire\MatchDetail;
// use App\Http\Livewire\TeamsList;
use App\Livewire\MatchDetail;
use App\Livewire\MatchesList;
use App\Livewire\StandingsList;
use App\Livewire\FavoriteTeamsList;
use Illuminate\Support\Facades\Route;
// use App\Http\Livewire\FavoritesList;


// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', LeaguesList::class)->name('leagues');
Route::get('/league/{leagueId}/matches', MatchesList::class)->name('matches');
Route::get('/match/{eventId}', MatchDetail::class)->name('match');
Route::get('/league/{leagueId}/standings', StandingsList::class)->name('standings');
// Route::get('/league/{leagueId}/teams', TeamsList::class)->name('teams');
Route::get('/team/{teamId}', TeamDetail::class)->name('team');
Route::get('/league/{leagueId}/teams', TeamsList::class)->name('teams');

// Route::get('/league/{leagueId}/teams', TeamsList::class)->name('teams');
Route::get('/team/{teamId}', TeamDetail::class)->name('team');
Route::get('/favorites', FavoriteTeamsList::class)->name('favorites');
Route::get('/team/{teamId}', TeamDetail::class)->name('team');
// Route::get('/favorites', FavoritesList::class)->name('favorites');
