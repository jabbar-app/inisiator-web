<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => null, // Will be overridden in seeder
            'category_id' => null, // Will be overridden in seeder
            'img_featured' => $this->faker->imageUrl(640, 480, 'articles', true),
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->unique()->slug(),
            'content' => $this->faker->paragraphs(5, true),
            'is_featured' => $this->faker->boolean(30),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
            'views' => $this->faker->numberBetween(0, 5000),
            'earnings' => $this->faker->randomFloat(2, 0, 5000),
        ];
    }
}
