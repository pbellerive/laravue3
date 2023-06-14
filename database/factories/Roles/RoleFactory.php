<?php

namespace Database\Factories\Roles;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Role>
 */
class RoleFactory extends Factory
{
    protected $model = \App\Roles\Role::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(15)
        ];
    }
}
