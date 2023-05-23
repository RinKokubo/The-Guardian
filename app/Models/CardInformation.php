<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardInformation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_id',
        'attacker_select_id',
        'defender_card1_score',
        'defender_card2_score',
        'defender_card3_score',
        'defender_card4_score',
        'defender_card5_score',
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
