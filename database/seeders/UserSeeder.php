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

        $admin = User::create([
            'first_name' =>  'superadmin',
            'last_name' => 'superadmin',
            'email' => 'user@laravue.test',
            'password' => password_hash('123456', PASSWORD_BCRYPT),
        ]);

        $admin->assignRole(\App\Roles\Role::where('name', '=', 'superadmin')->first());

        User::factory()->count(5)->create([
            'password' => password_hash('123456', PASSWORD_BCRYPT),
        ]);
    }
}
