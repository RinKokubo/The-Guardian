<?php

namespace Database\Seeders;

use App\Models\AttackerCardInfo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(AttackerCardSeeder::class);
        $this->call(DefenderCardSeeder::class);
        $this->call(GameInformationSeeder::class);
        $this->call(CardInformationSeeder::class);
        $this->call(NoticeSeeder::class);
        $this->call(MatchInfoSeeder::class);
        $this->call(AttackerCardsInfoTableSeeder::class);
    }
}
