<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $texts = fake()->paragraphs(10);
        $text = join('', array_map(fn ($text) => '<p>' . $text . '</p>', $texts));
        return [
            'title' => fake()->sentence(),
            'description' => $text,
        ];
    }
}
