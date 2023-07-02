<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'zemi1',
            'password' => 11111,
            'is_logged_in' => 1,
        ]);

        User::create([
            'name' => 'zemi2',
            'password' => 11112,
            'is_logged_in' => 1,
        ]);
        User::create([
            'name' => 'zemi3',
            'password' => 11113,
            'is_logged_in' => 1,
        ]);

        User::create([
            'name' => 'zemi4',
            'password' => 11114,
            'is_logged_in' => 1,
        ]);

        User::create([
            'name' => 'zemi5',
            'password' => 11115,
            'is_logged_in' => 1,
        ]);

        User::create([
            'name' => 'zemi6',
            'password' => 11116,
            'is_logged_in' => 1,
        ]);

        User::create([
            'name' => 'zemi7',
            'password' => 11117,
            'is_logged_in' => 1,
        ]);

        User::create([
            'name' => 'zemi8',
            'password' => 11118,
            'is_logged_in' => 1,
        ]);
        User::create([
            'name' => 'zemi9',
            'password' => 11119,
            'is_logged_in' => 1,
        ]);

        User::create([
            'name' => 'zemi10',
            'password' => 111110,
            'is_logged_in' => 1,
        ]);

        User::create([
            'name' => 'zemi11',
            'password' => 111111,
            'is_logged_in' => 1,
        ]);

        User::create([
            'name' => 'zemi12',
            'password' => 111112,
            'is_logged_in' => 1,
        ]);

        User::create([
            'name' => 'zemi13',
            'password' => 111113,
            'is_logged_in' => 1,
        ]);

        User::create([
            'name' => 'zemi14',
            'password' => 111114,
            'is_logged_in' => 1,
        ]);
    }
}
