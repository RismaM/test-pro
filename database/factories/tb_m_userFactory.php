<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\tb_m_user;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\tb_m_user>
 */
class tb_m_userFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = tb_m_user::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'username' => fake() -> name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'user', // password
            'status' => 'active',
            'role' => 'siswa',
            'created_by_tmu' => '1',
        ];
    }
 /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
   
