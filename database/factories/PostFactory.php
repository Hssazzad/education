<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence();

        return [
            'title'        => $title,
            'slug'         => Str::slug($title),
            'content'      => $this->faker->paragraphs(5, true),
            'images'       => $this->faker->imageUrl(),
            'category_id'  => Category::inRandomOrder()->first()->id ?? 1,
            'user_id'      => 1,
            'published_at' => $this->faker->optional()->dateTime(),
        ];
    }
}
