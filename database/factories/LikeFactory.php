<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $likeable = $this->likeable();

        return [
            'is_liked' => 1,
            'user_id' => User::factory(),
            'likeable_id' => $likeable::factory(),
            'likeable_type' => $likeable
        ];
    }

    public function likeable()
    {
        return $this->faker->randomElement([
            Article::class,
            Comment::class,
        ]);
    }
}
