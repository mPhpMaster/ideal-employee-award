<?php

namespace Database\Factories;

use App\Models\Award;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AwardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Award::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->word,
            'max_employee_points' => $this->faker->randomNumber,
        ];
    }
}
