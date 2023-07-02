<?php

namespace Database\Seeders;

use App\Models\CardInformation;
use Illuminate\Database\Seeder;

class CardInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        $this->call(GameInformationSeeder::class);

        // game1
        CardInformation::create([
            'game_id' => 1,
            'attacker_select_id' => 1,
            'defender_card1_score' => 35,
            'defender_card2_score' => 35,
            'defender_card3_score' => 10,
            'defender_card4_score' => 15,
            'defender_card5_score' => 5,
        ]);
        CardInformation::create([
            'game_id' => 1,
            'attacker_select_id' => 2,
            'defender_card1_score' => 5,
            'defender_card2_score' => 15,
            'defender_card3_score' => 15,
            'defender_card4_score' => 50,
            'defender_card5_score' => 15,
        ]);
        CardInformation::create([
            'game_id' => 1,
            'attacker_select_id' => 3,
            'defender_card1_score' => 5,
            'defender_card2_score' => 10,
            'defender_card3_score' => 60,
            'defender_card4_score' => 5,
            'defender_card5_score' => 20,
        ]);
        // game2
        CardInformation::create([
            'game_id' => 2,
            'attacker_select_id' => 1,
            'defender_card1_score' => 10,
            'defender_card2_score' => 40,
            'defender_card3_score' => 5,
            'defender_card4_score' => 25,
            'defender_card5_score' => 20,
        ]);
        CardInformation::create([
            'game_id' => 2,
            'attacker_select_id' => 2,
            'defender_card1_score' => 5,
            'defender_card2_score' => 5,
            'defender_card3_score' => 20,
            'defender_card4_score' => 35,
            'defender_card5_score' => 35,
        ]);
        CardInformation::create([
            'game_id' => 2,
            'attacker_select_id' => 3,
            'defender_card1_score' => 40,
            'defender_card2_score' => 30,
            'defender_card3_score' => 10,
            'defender_card4_score' => 10,
            'defender_card5_score' => 10,
        ]);
        // game3
        CardInformation::create([
            'game_id' => 3,
            'attacker_select_id' => 1,
            'defender_card1_score' => 20,
            'defender_card2_score' => 35,
            'defender_card3_score' => 30,
            'defender_card4_score' => 5,
            'defender_card5_score' => 10,
        ]);
        CardInformation::create([
            'game_id' => 3,
            'attacker_select_id' => 2,
            'defender_card1_score' => 0,
            'defender_card2_score' => 20,
            'defender_card3_score' => 40,
            'defender_card4_score' => 40,
            'defender_card5_score' => 0,
        ]);
        CardInformation::create([
            'game_id' => 3,
            'attacker_select_id' => 3,
            'defender_card1_score' => 30,
            'defender_card2_score' => 0,
            'defender_card3_score' => 5,
            'defender_card4_score' => 50,
            'defender_card5_score' => 15,
        ]);
        // game4
        CardInformation::create([
            'game_id' => 4,
            'attacker_select_id' => 1,
            'defender_card1_score' => 50,
            'defender_card2_score' => 20,
            'defender_card3_score' => 10,
            'defender_card4_score' => 0,
            'defender_card5_score' => 20,
        ]);
        CardInformation::create([
            'game_id' => 4,
            'attacker_select_id' => 2,
            'defender_card1_score' => 5,
            'defender_card2_score' => 5,
            'defender_card3_score' => 5,
            'defender_card4_score' => 5,
            'defender_card5_score' => 80,
        ]);
        CardInformation::create([
            'game_id' => 4,
            'attacker_select_id' => 3,
            'defender_card1_score' => 0,
            'defender_card2_score' => 10,
            'defender_card3_score' => 20,
            'defender_card4_score' => 70,
            'defender_card5_score' => 0,
        ]);
        // game5
        CardInformation::create([
            'game_id' => 5,
            'attacker_select_id' => 1,
            'defender_card1_score' => 40,
            'defender_card2_score' => 5,
            'defender_card3_score' => 20,
            'defender_card4_score' => 0,
            'defender_card5_score' => 35,
        ]);
        CardInformation::create([
            'game_id' => 5,
            'attacker_select_id' => 2,
            'defender_card1_score' => 30,
            'defender_card2_score' => 30,
            'defender_card3_score' => 5,
            'defender_card4_score' => 10,
            'defender_card5_score' => 25,
        ]);
        CardInformation::create([
            'game_id' => 5,
            'attacker_select_id' => 3,
            'defender_card1_score' => 10,
            'defender_card2_score' => 5,
            'defender_card3_score' => 20,
            'defender_card4_score' => 20,
            'defender_card5_score' => 45,
        ]);
        // game6
        CardInformation::create([
            'game_id' => 6,
            'attacker_select_id' => 1,
            'defender_card1_score' => 10,
            'defender_card2_score' => 10,
            'defender_card3_score' => 30,
            'defender_card4_score' => 10,
            'defender_card5_score' => 40,
        ]);
        CardInformation::create([
            'game_id' => 6,
            'attacker_select_id' => 2,
            'defender_card1_score' => 30,
            'defender_card2_score' => 30,
            'defender_card3_score' => 5,
            'defender_card4_score' => 10,
            'defender_card5_score' => 25,
        ]);
        CardInformation::create([
            'game_id' => 6,
            'attacker_select_id' => 3,
            'defender_card1_score' => 20,
            'defender_card2_score' => 20,
            'defender_card3_score' => 5,
            'defender_card4_score' => 50,
            'defender_card5_score' => 5,
        ]);
    }
}
