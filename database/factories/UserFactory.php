<?php

namespace Database\Factories;

use App\Interfaces\IRole;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 *
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $name = $this->faker->firstName,
            'email' => $this->faker->unique->email,
            'email_verified_at' => now(),
            'password' => \Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => $this->faker->randomElement(
                Role::getAllRoles(except: [ IRole::AdminRole, IRole::SuperAdminRole ])->toArray()
            ),
            'phone' => $this->faker->phoneNumber(),
            'image' => (new \Illuminate\Http\UploadedFile($image = $this->faker->image(word: $name),basename($image))),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function(array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
