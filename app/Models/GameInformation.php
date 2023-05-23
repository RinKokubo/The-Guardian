<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameInformation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attacker_card1_id',
        'attacker_card2_id',
        'attacker_card3_id',
        'defender_card1_id',
        'defender_card2_id',
        'defender_card3_id',
        'defender_card4_id',
        'defender_card5_id',
    ];

    public function attacker_card1()
    {
        return $this->belongsTo(AttackerCard::class, 'attacker_card1_id');
    }

    public function attacker_card2()
    {
        return $this->belongsTo(AttackerCard::class, 'attacker_card2_id');
    }

    public function attacker_card3()
    {
        return $this->belongsTo(AttackerCard::class, 'attacker_card3_id');
    }

    public function defender_card1()
    {
        return $this->belongsTo(DefenderCard::class, 'defender_card1_id');
    }

    public function defender_card2()
    {
        return $this->belongsTo(DefenderCard::class, 'defender_card2_id');
    }

    public function defender_card3()
    {
        return $this->belongsTo(DefenderCard::class, 'defender_card3_id');
    }

    public function defender_card4()
    {
        return $this->belongsTo(DefenderCard::class, 'defender_card4_id');
    }

    public function defender_card5()
    {
        return $this->belongsTo(DefenderCard::class, 'defender_card5_id');
    }
}
