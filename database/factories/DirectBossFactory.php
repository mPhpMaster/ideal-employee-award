<?php

namespace Database\Factories;

use App\Models\DirectBoss;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class DirectBossFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DirectBoss::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique->email,
            'employee_number' => $this->faker->unique->randomNumber,
            'phone' => $this->faker->phoneNumber,
            'position_id' => \App\Models\Position::factory(),
        ];
    }
}
