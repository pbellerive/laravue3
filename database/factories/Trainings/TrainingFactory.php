<?php

namespace Database\Factories\Trainings;

use App\Trainings\Training;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Training::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'New training' . $this->faker->randomNumber(),
            'training_type_id' => 'c'
        ];
    }
}
