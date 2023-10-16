<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Master;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Agent>
 */
class AgentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $percent = [10,20,30,40,50,60];
        return [
            'master_id' => Master::inRandomOrder()->first()->id,
            'name' => $this->faker->name(),
            'username' => 'AG'.str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT),
            'percentage' => $this->faker->randomElement($percent),
            'password' => 'password', // password
            'remember_token' => Str::random(10),
        ];
    }
}
