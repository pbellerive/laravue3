<?php

namespace Database\Factories;

use App\Muscles\Muscle;
use Illuminate\Database\Eloquent\Factories\Factory;

class MuscleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Muscle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'Muscle'
        ];
    }
}
