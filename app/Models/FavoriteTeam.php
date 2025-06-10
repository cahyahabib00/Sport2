<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteTeam extends Model
{
    protected $fillable = ['team_id', 'team_name', 'logo_url'];
}
