<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment' => fake()->text,
            'user_id'=> User::factory(),
            'parent_id'=> null,
            'published'=>fake()->boolean,
            'commentable_type' => '',
            'commentable_id' => 1,
        ];
    }
}
