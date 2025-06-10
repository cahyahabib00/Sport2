<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class SportsDbService
{
    protected $baseUrl = 'https://www.thesportsdb.com/api/v1/json/3';

   public function getSoccerLeagues()
    {
        try {
            $response = Http::get("{$this->baseUrl}/all_leagues.php");
            \Log::info('Leagues API Status: ' . $response->status());
            \Log::info('Leagues API Response: ', $response->json());
            $leagues = collect($response->json()['leagues'] ?? [])
                ->filter(fn($league) => isset($league['strSport']) && $league['strSport'] === 'Soccer')
                ->map(function ($league) {
                    \Log::info('League: ' . $league['strLeague'] . ', Badge URL: ' . ($league['strBadge'] ?? 'No badge'));
                    return [
                        'idLeague' => $league['idLeague'],
                        'strLeague' => $league['strLeague'],
                        'strBadge' => $league['strBadge'] ?? null,
                        'strSport' => $league['strSport'],
                    ];
                })
                ->values();
            return $leagues;
        } catch (\Exception $e) {
            \Log::error('Failed to fetch soccer leagues: ' . $e->getMessage());
            return collect([]);
        }
    }

    public function getPastMatches($leagueId)
    {
        try {
            // Ambil semua liga
            $leaguesResponse = Http::get("{$this->baseUrl}/all_leagues.php");
            $leagues = collect($leaguesResponse->json()['leagues']);

            // Validasi bahwa liga ini adalah sepak bola
            $isSoccer = $leagues
                ->first(fn($league) => $league['idLeague'] == $leagueId && $league['strSport'] === 'Soccer');

            if (!$isSoccer) {
                Log::warning("League ID {$leagueId} is not a soccer league.");
                return collect([]);
            }

            // Ambil pertandingan jika valid
            $response = Http::timeout(10)->get("{$this->baseUrl}/eventspastleague.php?id={$leagueId}");
            Log::info('Matches API Status: ' . $response->status());
            Log::info('Matches API Response: ', $response->json());

            return collect($response->json()['events'] ?? [])
                ->map(function ($match) {
                    return [
                        'idEvent' => $match['idEvent'],
                        'strHomeTeam' => $match['strHomeTeam'],
                        'strAwayTeam' => $match['strAwayTeam'],
                        'intHomeScore' => $match['intHomeScore'] ?? '-',
                        'intAwayScore' => $match['intAwayScore'] ?? '-',
                        'dateEvent' => $match['dateEvent'],
                        'strTime' => $match['strTime'] ?? '00:00:00',
                        'strVenue' => $match['strVenue'] ?? 'Unknown',
                    ];
                })
                ->values();
        } catch (\Exception $e) {
            Log::error('Failed to fetch past matches: ' . $e->getMessage());
            return collect([]);
        }
    }

    public function getMatchDetails($eventId)
    {
        try {
            $response = Http::timeout(10)->get("{$this->baseUrl}/lookupevent.php?id={$eventId}");
            Log::info('Match Details API Status: ' . $response->status());
            Log::info('Match Details API Response: ', $response->json());
            $event = $response->json()['events'][0] ?? [];
            return [
                'idEvent' => $event['idEvent'] ?? null,
                'strHomeTeam' => $event['strHomeTeam'] ?? 'Unknown',
                'strAwayTeam' => $event['strAwayTeam'] ?? 'Unknown',
                'intHomeScore' => $event['intHomeScore'] ?? '-',
                'intAwayScore' => $event['intAwayScore'] ?? '-',
                'dateEvent' => $event['dateEvent'] ?? null,
                'strTime' => $event['strTime'] ?? '00:00:00',
                'strVenue' => $event['strVenue'] ?? 'Unknown',
                'strHomeTeamBadge' => $event['strHomeTeamBadge'] ?? 'https://via.placeholder.com/96',
                'strAwayTeamBadge' => $event['strAwayTeamBadge'] ?? 'https://via.placeholder.com/96',
                'strLeague' => $event['strLeague'] ?? 'Unknown',
                'strSeason' => $event['strSeason'] ?? 'Unknown',
                'strStatus' => $event['strStatus'] ?? 'Unknown',
            ];
        } catch (\Exception $e) {
            Log::error('Failed to fetch match details: ' . $e->getMessage());
            return [];
        }
    }


    
    public function getStandings($leagueId, $season = '2023-2024')
    {
        try {
            // Endpoint ini hanya berfungsi jika tersedia untuk liga tertentu
            $response = Http::timeout(10)->get("{$this->baseUrl}/lookuptable.php?l={$leagueId}&s={$season}");
            Log::info('Standings API Status: ' . $response->status());
            Log::info('Standings API Response: ', $response->json());
            $table = $response->json()['table'] ?? [];
            return collect($table)->map(function ($team) {
                return [
                    'name' => $team['name'] ?? 'Unknown',
                    'teamid' => $team['teamid'] ?? null,
                    'played' => $team['played'] ?? 0,
                    'goalsfor' => $team['goalsfor'] ?? 0,
                    'goalsagainst' => $team['goalsagainst'] ?? 0,
                    'goalsdifference' => $team['goalsdifference'] ?? 0,
                    'win' => $team['win'] ?? 0,
                    'draw' => $team['draw'] ?? 0,
                    'loss' => $team['loss'] ?? 0,
                    'total' => $team['total'] ?? 0,
                ];
            })->values();
        } catch (\Exception $e) {
            \Log::error("Failed to fetch standings: " . $e->getMessage());
            return collect([]);
        }
    }

    public function getTeams($leagueId)
    {
        $response = Http::get("{$this->baseUrl}/lookup_all_teams.php?id={$leagueId}");
        return $response->json()['teams'] ?? [];
    }

    


    public function getTeamDetails($teamId)
    {
        try {
            $response = Http::timeout(10)->get("{$this->baseUrl}/lookupteam.php?id={$teamId}");
            Log::info('Team Details API Status: ' . $response->status());
            Log::info('Team Details API Response: ', $response->json());
            $team = $response->json()['teams'][0] ?? [];
            return [
                'idTeam' => $team['idTeam'] ?? null,
                'strTeam' => $team['strTeam'] ?? 'Unknown',
                'strTeamBadge' => $team['strTeamBadge'] ?? 'https://via.placeholder.com/96',
                'strDescriptionEN' => $team['strDescriptionEN'] ?? 'No description available.',
                'strStadium' => $team['strStadium'] ?? 'Unknown',
                'strManager' => $team['strManager'] ?? 'Unknown',
                'strCountry' => $team['strCountry'] ?? 'Unknown',
                'intFormedYear' => $team['intFormedYear'] ?? 'Unknown',
                'strWebsite' => $team['strWebsite'] ? 'https://' . $team['strWebsite'] : null,
            ];
        } catch (\Exception $e) {
            Log::error('Failed to fetch team details: ' . $e->getMessage());
            return [];
        }
    }

    public function getTeamsByLeague($leagueId)
    {
        try {
            // Dapatkan nama liga dari leagueId
            $leagueResponse = Http::timeout(10)->get("{$this->baseUrl}/lookupleague.php?id={$leagueId}");
            Log::info('League Lookup API Status: ' . $leagueResponse->status());
            Log::info('League Lookup API Response: ', $leagueResponse->json());
            $leagueName = $leagueResponse->json()['leagues'][0]['strLeague'] ?? null;

            if (!$leagueName) {
                Log::error('League name not found for ID: ' . $leagueId);
                return collect([]);
            }

            // Gunakan nama liga untuk mencari tim
            $response = Http::timeout(10)->get("{$this->baseUrl}/search_all_teams.php", [
                'l' => $leagueName
            ]);
            Log::info('Teams API Status: ' . $response->status());
            Log::info('Teams API Response: ', $response->json());
            return collect($response->json()['teams'] ?? [])
                ->map(function ($team) {
                    if (!empty($team['strTeamBadge']) && filter_var($team['strTeamBadge'], FILTER_VALIDATE_URL)) {
                        $filename = 'team_' . md5($team['strTeamBadge']) . '.png';
                        $path = storage_path('app/public/badges/' . $filename);
                        if (!file_exists($path)) {
                            try {
                                $image = Http::get($team['strTeamBadge'])->body();
                                \Storage::disk('public')->put('badges/' . $filename, $image);
                            } catch (\Exception $e) {
                                Log::error('Failed to cache team badge: ' . $e->getMessage());
                                $team['strTeamBadge'] = null;
                            }
                        }
                        $team['strTeamBadge'] = asset('storage/badges/' . $filename);
                    }
                    return [
                        'idTeam' => $team['idTeam'] ?? null,
                        'strTeam' => $team['strTeam'] ?? 'Unknown',
                        'strTeamBadge' => $team['strTeamBadge'] ?? null,
                    ];
                })
                ->values();
        } catch (\Exception $e) {
            Log::error('Failed to fetch teams for league ID ' . $leagueId . ': ' . $e->getMessage());
            return collect([]);
        }
    }
}