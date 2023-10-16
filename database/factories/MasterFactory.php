<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Senior;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Master>
 */
class MasterFactory extends Factory
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
            'senior_id' => Senior::inRandomOrder()->first()->id,
            'name' => $this->faker->name(),
            'username' => 'MS'.str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT),
            'percentage' => $this->faker->randomElement($percent),
            'password' => 'password', // password
            'remember_token' => Str::random(10),
        ];
    }
}
