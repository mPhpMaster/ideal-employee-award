<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'employee_number' => $this->faker->unique->randomNumber,
            'position_id' => \App\Models\Position::factory(),
            'direct_boss_id' => \App\Models\DirectBoss::factory(),
        ];
    }
}
