<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\TechnicalCommittee;
use Illuminate\Database\Eloquent\Factories\Factory;

class TechnicalCommitteeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TechnicalCommittee::class;

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
