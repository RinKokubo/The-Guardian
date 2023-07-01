<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserScore extends Model
{
    protected $fillable = [
        'game_id',
        'attacker_select_id',
        'user_name',
        'user_card1_score',
        'user_card2_score',
        'user_card3_score',
        'user_card4_score',
        'user_card5_score',
    ];

    public function game_id()
    {
        return $this->belongsTo(GameInformation::class, 'game_id');
    }

    public function attacker_select_id()
    {
        return $this->belongsTo(AttackerCard::class, 'attacker_select_id');
    }
}
