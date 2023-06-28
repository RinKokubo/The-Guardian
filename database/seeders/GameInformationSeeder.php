<?php

namespace Database\Seeders;

use App\Models\GameInformation;
use Illuminate\Database\Seeder;

class GameInformationSeeder extends Seeder
{
    public function run()
    {
        GameInformation::create([
            'attacker_card1_id' => 1,
            'attacker_card2_id' => 2,
            'attacker_card3_id' => 3,
            'defender_card1_id' => 1,
            'defender_card2_id' => 2,
            'defender_card3_id' => 3,
            'defender_card4_id' => 4,
            'defender_card5_id' => 5,
        ]);

        GameInformation::create([
            'attacker_card1_id' => 4,
            'attacker_card2_id' => 12,
            'attacker_card3_id' => 17,
            'defender_card1_id' => 1,
            'defender_card2_id' => 6,
            'defender_card3_id' => 4,
            'defender_card4_id' => 3,
            'defender_card5_id' => 2,
        ]);

        GameInformation::create([
            'attacker_card1_id' => 5,
            'attacker_card2_id' => 6,
            'attacker_card3_id' => 17,
            'defender_card1_id' => 7,
            'defender_card2_id' => 8,
            'defender_card3_id' => 4,
            'defender_card4_id' => 9,
            'defender_card5_id' => 10,
        ]);

        GameInformation::create([
            'attacker_card1_id' => 7,
            'attacker_card2_id' => 13,
            'attacker_card3_id' => 18,
            'defender_card1_id' => 11,
            'defender_card2_id' => 4,
            'defender_card3_id' => 12,
            'defender_card4_id' => 13,
            'defender_card5_id' => 2,
        ]);

        GameInformation::create([
            'attacker_card1_id' => 8,
            'attacker_card2_id' => 14,
            'attacker_card3_id' => 19,
            'defender_card1_id' => 14,
            'defender_card2_id' => 3,
            'defender_card3_id' => 15,
            'defender_card4_id' => 16,
            'defender_card5_id' => 2,
        ]);

        GameInformation::create([
            'attacker_card1_id' => 9,
            'attacker_card2_id' => 15,
            'attacker_card3_id' => 3,
            'defender_card1_id' => 2,
            'defender_card2_id' => 4,
            'defender_card3_id' => 7,
            'defender_card4_id' => 3,
            'defender_card5_id' => 1,
        ]);
    }
}
