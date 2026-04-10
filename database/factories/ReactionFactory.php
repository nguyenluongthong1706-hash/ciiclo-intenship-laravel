<?php

namespace Database\Factories;

use App\Models\Reaction;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Rating>
 */
class ReactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'type' => fake()->randomElement(['like','dislike','love','angry']),
            'reviewer_id' => User::inRandomOrder()->first()->id,
            'post_id' => Post::inRandomOrder()->first()->id
        ];
    }
}
