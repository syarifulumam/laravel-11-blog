<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(5),
            'body' => fake()->paragraph(),
            'thumbnail' => fake()->imageUrl(640, 480, 'article', true),
            'meta_description' => fake()->text(100),
            'user_id' => User::factory(),
            'category_id' => Category::factory()
        ];
    }
}
