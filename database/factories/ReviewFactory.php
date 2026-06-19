<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    protected $model = Review::class;

    public function definition(): array
    {
        return [
            'author_name' => fake()->name(),
            'author_location' => 'Волгоград',
            'content' => fake()->paragraph(3),
            'rating' => fake()->numberBetween(4, 5),
            'is_published' => true,
            'sort_order' => fake()->numberBetween(0, 20),
        ];
    }
}
