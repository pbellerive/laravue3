<?php

namespace Database\Seeders;

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
        $this->call('Database\Seeders\UserSeeder');
        $this->call('Database\Seeders\MuscleSeeder');
        $this->call('Database\Seeders\ExerciseSeeder');
        $this->call('Database\Seeders\TrainingSeeder');
        $this->call('Database\Seeders\ExerciseTrainingSeeder');
    }
}
