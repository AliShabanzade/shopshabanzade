<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'url' => fake()->url,
            'extension' => fake()->randomElement(['pdf' , 'jpg']),
            'size' => rand(1,3),
            'mediable_type' => '',
            'mediable_id' => 1,
            'user_id' => User::factory(),

        ];
    }
}
