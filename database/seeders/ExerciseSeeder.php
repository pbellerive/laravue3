<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Exercises\Exercise;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Users\User::first();
        $muscle = \App\Muscles\Muscle::first();

        Exercise::create([
            'name' => 'Exercice 1',
            'main_muscle_id' => $muscle->id,
            'impact_level' => 'h',
            'owner_id' => $user->id
        ]);

        $muscle = \App\Muscles\Muscle::offset(2)->first();

        Exercise::create([
            'name' => 'Exercice 2',
            'main_muscle_id' => $muscle->id,
            'impact_level' => 'l',
            'owner_id' => $user->id
        ]);

        $user = \App\Users\User::offset(1)->first();
        $muscle = \App\Muscles\Muscle::first();

        Exercise::create([
            'name' => 'Exercice 3',
            'main_muscle_id' => $muscle->id,
            'impact_level' => 'h',
            'owner_id' => $user->id
        ]);

        $muscle = \App\Muscles\Muscle::offset(1)->first();

        Exercise::create([
            'name' => 'Exercice 4',
            'main_muscle_id' => $muscle->id,
            'impact_level' => 'l',
            'owner_id' => $user->id
        ]);

    }
}
