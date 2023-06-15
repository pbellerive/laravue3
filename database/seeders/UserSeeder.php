<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Users\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        User::create([
            'first_name' =>  'Patrick',
            'last_name' => 'Bellerive',
            'email' => 'user@laravue.test',
            'password' => password_hash('123456', PASSWORD_BCRYPT),
        ]);

        User::factory()->count(5)->create([
            'password' => password_hash('123456', PASSWORD_BCRYPT),
        ]);
    }
}
