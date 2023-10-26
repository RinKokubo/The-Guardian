<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchInfo extends Model
{
    use HasFactory;

    protected $table = 'match_info';

    protected $fillable = [
        'user_id',
        'game_id',
        'opponent_id',
        'user_role'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function game()
    {
        return $this->belongsTo(GameInformation::class, 'game_id');
    }

    public function opponent()
    {
        return $this->belongsTo(User::class, 'opponent_id');
    }
}
