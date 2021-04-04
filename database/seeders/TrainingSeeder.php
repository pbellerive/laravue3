<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Trainings\Training;

class TrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Users\User::first();

        Training::create([
            'name' => 'Entrainement debutant',
            'owner_id' => $user->id,
            'training_type_id' => 'c'
        ]);

        Training::create([
            'name' => 'Entrainement intermediaire',
            'owner_id' => $user->id,
            'training_type_id' => 'f'
        ]);

        Training::create([
            'name' => 'Entrainement avance',
            'owner_id' => $user->id,
            'training_type_id' => 'c'
        ]);

        $user = \App\Users\User::offset(1)->first();

        Training::create([
            'name' => 'Entrainement debutant 1',
            'owner_id' => $user->id,
            'training_type_id' => 'e'
        ]);

        Training::create([
            'name' => 'Entrainement intermediaire 1',
            'owner_id' => $user->id,
            'training_type_id' => 'c'
        ]);

        Training::create([
            'name' => 'Entrainement avance 1',
            'owner_id' => $user->id,
            'training_type_id' => 'e'
        ]);
    }
}
