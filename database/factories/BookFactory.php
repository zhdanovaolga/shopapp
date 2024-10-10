<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $texts = fake()->paragraphs(1);
        $text = join('', array_map(fn ($text) => '<p>' . $text . '</p>', $texts));
        return [
            'title' => fake()->sentence(),
            'description' => fake()->sentence(),
            'image' => '',//Post::random(10),
            'price' => fake()->numberBetween(0, 500),
            'category_id' => Category::factory(),
            'publish_year' => fake()->year(),
            'rented' => fake()->boolean(),
            'purchased' => fake()->boolean(),
            'rented_date' => fake()->date(),
            'current_user_id' => User::factory(),
        ];
    }
}
