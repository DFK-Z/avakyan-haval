<?php

namespace Database\Factories;

use App\Enums\CarCategory;
use App\Enums\CarLine;
use App\Enums\DriveType;
use App\Models\CarModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<CarModel>
 */
class CarModelFactory extends Factory
{
    protected $model = CarModel::class;

    public function definition(): array
    {
        $name = fake()->words(2, true);

        return [
            'brand' => 'Haval',
            'line' => fake()->randomElement(CarLine::cases()),
            'name' => ucfirst($name),
            'slug' => Str::slug($name.'-'.fake()->unique()->numerify('###')),
            'category' => fake()->randomElement(CarCategory::cases()),
            'drive_type' => fake()->randomElement(DriveType::cases()),
            'price_from' => fake()->numberBetween(1_500_000, 4_500_000),
            'specs' => [
                'engine' => fake()->randomElement(['1.5T', '2.0T', 'Hybrid']),
                'power' => fake()->numberBetween(140, 220).' л.с.',
            ],
            'seats' => fake()->randomElement([5, 7]),
            'doors' => fake()->randomElement([4, 5]),
            'transmission' => 'Автомат',
            'hero_image' => null,
            'is_active' => true,
            'is_popular' => fake()->boolean(30),
            'sort_order' => fake()->numberBetween(0, 100),
        ];
    }

    public function popular(): static
    {
        return $this->state(fn (): array => ['is_popular' => true]);
    }
}
