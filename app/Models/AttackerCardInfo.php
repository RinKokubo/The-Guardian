<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttackerCardInfo extends Model
{
    use HasFactory;

    protected $table = 'attacker_cards_info';

    protected $fillable = [
        'attacker_card_id',
        'attacker_card_info',
    ];


    public function attacker_card()
    {
        return $this->belongsTo(AttackerCard::class, 'attacker_card_id');
    }
}
