<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameResult extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attacker__id',
        'defender_id',
        'game_id',
        'attacker_select_id',
        'defender_select_1',
        'defender_select_2',
        'defender_select_3',
        'defender_select_4',
        'defender_select_5',
        'attacker_score',
        'defender_score'
    ];

    public function attacker_id()
    {
        return $this->belongsTo(User::class, 'attacker_id');
    }

    public function defender_id()
    {
        return $this->belongsTo(User::class, 'attacker_id');
    }

    public function game_id()
    {
        return $this->belongsTo(GameInformation::class, 'game_id');
    }

    public function attacker_select_id()
    {
        return $this->belongsTo(AttackerCard::class, 'attacker_id');
    }
}
