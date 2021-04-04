<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Muscles\Muscle;

class MuscleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Muscle::create([ 'name' => 'Biceps' ]);
        Muscle::create([ 'name' => 'Triceps' ]);
        Muscle::create([ 'name' => 'Quadriceps' ]);
    }
}
