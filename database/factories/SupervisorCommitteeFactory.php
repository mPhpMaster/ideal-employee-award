<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\SupervisorCommittee;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupervisorCommitteeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SupervisorCommittee::class;

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
        ];
    }
}
