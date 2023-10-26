<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MatchInfo;

class MatchInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MatchInfo::create([
            'user_id' => 1,
            'game_id' => 1,
            'opponent_id' => 2,
            'user_role' => 'attacker',
        ]);

        MatchInfo::create([
            'user_id' => 2,
            'game_id' => 1,
            'opponent_id' => 1,
            'user_role' => 'defender',
        ]);

        MatchInfo::create([
            'user_id' => 3,
            'game_id' => 1,
            'opponent_id' => 31,
            'user_role' => 'defender',
        ]);
    }
}
