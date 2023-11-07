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
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 2,
            'game_id' => 1,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 3,
            'game_id' => 1,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 4,
            'game_id' => 1,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 5,
            'game_id' => 1,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 6,
            'game_id' => 1,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 7,
            'game_id' => 1,
            'opponent_id' => 11,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 8,
            'game_id' => 1,
            'opponent_id' => 10,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 9,
            'game_id' => 1,
            'opponent_id' => 12,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 10,
            'game_id' => 1,
            'opponent_id' => 8,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 11,
            'game_id' => 1,
            'opponent_id' => 7,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 12,
            'game_id' => 1,
            'opponent_id' => 9,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 13,
            'game_id' => 1,
            'opponent_id' => 14,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 14,
            'game_id' => 1,
            'opponent_id' => 13,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 15,
            'game_id' => 1,
            'opponent_id' => 16,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 16,
            'game_id' => 1,
            'opponent_id' => 15,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 17,
            'game_id' => 1,
            'opponent_id' => 18,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 18,
            'game_id' => 1,
            'opponent_id' => 17,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 19,
            'game_id' => 1,
            'opponent_id' => 20,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 20,
            'game_id' => 1,
            'opponent_id' => 19,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 1,
            'game_id' => 2,
            'opponent_id' => 5,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 2,
            'game_id' => 2,
            'opponent_id' => 4,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 3,
            'game_id' => 2,
            'opponent_id' => 6,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 4,
            'game_id' => 2,
            'opponent_id' => 2,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 5,
            'game_id' => 2,
            'opponent_id' => 1,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 6,
            'game_id' => 2,
            'opponent_id' => 3,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 7,
            'game_id' => 2,
            'opponent_id' => 8,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 8,
            'game_id' => 2,
            'opponent_id' => 7,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 9,
            'game_id' => 2,
            'opponent_id' => 10,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 10,
            'game_id' => 2,
            'opponent_id' => 9,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 11,
            'game_id' => 2,
            'opponent_id' => 12,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 12,
            'game_id' => 2,
            'opponent_id' => 11,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 13,
            'game_id' => 2,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 14,
            'game_id' => 2,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 15,
            'game_id' => 2,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 16,
            'game_id' => 2,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 17,
            'game_id' => 2,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 18,
            'game_id' => 2,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 19,
            'game_id' => 2,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 20,
            'game_id' => 2,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 1,
            'game_id' => 3,
            'opponent_id' => 2,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 2,
            'game_id' => 3,
            'opponent_id' => 1,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 3,
            'game_id' => 3,
            'opponent_id' => 4,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 4,
            'game_id' => 3,
            'opponent_id' => 3,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 5,
            'game_id' => 3,
            'opponent_id' => 6,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 6,
            'game_id' => 3,
            'opponent_id' => 5,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 7,
            'game_id' => 3,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 8,
            'game_id' => 3,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 9,
            'game_id' => 3,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 10,
            'game_id' => 3,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 11,
            'game_id' => 3,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 12,
            'game_id' => 3,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 13,
            'game_id' => 3,
            'opponent_id' => 18,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 14,
            'game_id' => 3,
            'opponent_id' => 17,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 15,
            'game_id' => 3,
            'opponent_id' => 20,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 16,
            'game_id' => 3,
            'opponent_id' => 19,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 17,
            'game_id' => 3,
            'opponent_id' => 14,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 18,
            'game_id' => 3,
            'opponent_id' => 13,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 19,
            'game_id' => 3,
            'opponent_id' => 16,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 20,
            'game_id' => 3,
            'opponent_id' => 15,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 1,
            'game_id' => 4,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 2,
            'game_id' => 4,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 3,
            'game_id' => 4,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 4,
            'game_id' => 4,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 5,
            'game_id' => 4,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 6,
            'game_id' => 4,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 7,
            'game_id' => 4,
            'opponent_id' => 9,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 8,
            'game_id' => 4,
            'opponent_id' => 11,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 9,
            'game_id' => 4,
            'opponent_id' => 7,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 10,
            'game_id' => 4,
            'opponent_id' => 12,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 11,
            'game_id' => 4,
            'opponent_id' => 8,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 12,
            'game_id' => 4,
            'opponent_id' => 10,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 13,
            'game_id' => 4,
            'opponent_id' => 20,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 14,
            'game_id' => 4,
            'opponent_id' => 15,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 15,
            'game_id' => 4,
            'opponent_id' => 14,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 16,
            'game_id' => 4,
            'opponent_id' => 17,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 17,
            'game_id' => 4,
            'opponent_id' => 16,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 18,
            'game_id' => 4,
            'opponent_id' => 19,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 19,
            'game_id' => 4,
            'opponent_id' => 18,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 20,
            'game_id' => 4,
            'opponent_id' => 13,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 1,
            'game_id' => 5,
            'opponent_id' => 3,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 2,
            'game_id' => 5,
            'opponent_id' => 5,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 3,
            'game_id' => 5,
            'opponent_id' => 1,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 4,
            'game_id' => 5,
            'opponent_id' => 6,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 5,
            'game_id' => 5,
            'opponent_id' => 2,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 6,
            'game_id' => 5,
            'opponent_id' => 4,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 7,
            'game_id' => 5,
            'opponent_id' => 12,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 8,
            'game_id' => 5,
            'opponent_id' => 9,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 9,
            'game_id' => 5,
            'opponent_id' => 8,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 10,
            'game_id' => 5,
            'opponent_id' => 11,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 11,
            'game_id' => 5,
            'opponent_id' => 10,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 12,
            'game_id' => 5,
            'opponent_id' => 7,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 13,
            'game_id' => 5,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 14,
            'game_id' => 5,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 15,
            'game_id' => 5,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 16,
            'game_id' => 5,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 17,
            'game_id' => 5,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 18,
            'game_id' => 5,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 19,
            'game_id' => 5,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 20,
            'game_id' => 5,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 1,
            'game_id' => 6,
            'opponent_id' => 6,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 2,
            'game_id' => 6,
            'opponent_id' => 3,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 3,
            'game_id' => 6,
            'opponent_id' => 2,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 4,
            'game_id' => 6,
            'opponent_id' => 5,
            'user_role' => 'defender',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 5,
            'game_id' => 6,
            'opponent_id' => 4,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 6,
            'game_id' => 6,
            'opponent_id' => 1,
            'user_role' => 'attacker',
            'comunication' => 'face'
        ]);

        MatchInfo::create([
            'user_id' => 7,
            'game_id' => 6,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 8,
            'game_id' => 6,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 9,
            'game_id' => 6,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 10,
            'game_id' => 6,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 11,
            'game_id' => 6,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 12,
            'game_id' => 6,
            'opponent_id' => 31,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 13,
            'game_id' => 6,
            'opponent_id' => 16,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 14,
            'game_id' => 6,
            'opponent_id' => 19,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 15,
            'game_id' => 6,
            'opponent_id' => 18,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 16,
            'game_id' => 6,
            'opponent_id' => 13,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 17,
            'game_id' => 6,
            'opponent_id' => 20,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 18,
            'game_id' => 6,
            'opponent_id' => 15,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 19,
            'game_id' => 6,
            'opponent_id' => 14,
            'user_role' => 'defender',
            'comunication' => 'chat'
        ]);

        MatchInfo::create([
            'user_id' => 20,
            'game_id' => 6,
            'opponent_id' => 17,
            'user_role' => 'attacker',
            'comunication' => 'chat'
        ]);
    }
}
