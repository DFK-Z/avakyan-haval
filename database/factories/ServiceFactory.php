<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        $name = fake()->words(3, true);

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => fake()->sentence(),
            'price' => fake()->numberBetween(2000, 25000),
            'category' => fake()->randomElement(['ТО', 'Кузов', 'Диагностика']),
            'is_active' => true,
        ];
    }
}
