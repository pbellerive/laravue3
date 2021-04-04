<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ExerciseTrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exercises = \App\Exercises\Exercise::limit(10)->get();
        $training = \App\Trainings\Training::first();

        $exercisesTraining = [];
        foreach($exercises as $exercise) {
            $exercisesTraining[$exercise->id] = [
                'duration_time' => 10,
                'break_time' => 2
            ];
        }

        $training->exercises()->attach($exercisesTraining);

    }
}
