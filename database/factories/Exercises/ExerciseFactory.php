<?php

namespace Database\Factories\Exercises;

use App\Exercises\Exercise;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExerciseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exercise::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $muscle = (new \Database\Factories\MuscleFactory)->create();
        return [
            'name' => 'Exercice ' . $this->faker->randomNumber(),
            'main_muscle_id' => $muscle->id,
            'impact_level' => 'h'
        ];
    }
}
