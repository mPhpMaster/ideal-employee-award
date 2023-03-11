<?php

namespace Database\Factories;

use App\Models\Application;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Application::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rank' => $this->faker->randomNumber,
            'direct_boss_points' => $this->faker->randomNumber,
            'supervisor_committee_points' => $this->faker->randomNumber,
            'technical_committee_points' => $this->faker->randomNumber,
            'employee_points' => $this->faker->randomNumber,
            'direct_boss_id' => \App\Models\DirectBoss::factory(),
            'employee_id' => \App\Models\Employee::factory(),
            'supervisor_committee_id' => \App\Models\SupervisorCommittee::factory(),
            'technical_committee_id' => \App\Models\TechnicalCommittee::factory(),
            'award_id' => \App\Models\Award::factory(),
        ];
    }
}
