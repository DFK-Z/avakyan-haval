<?php

namespace Database\Factories;

use App\Models\Part;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Part>
 */
class PartFactory extends Factory
{
    protected $model = Part::class;

    public function definition(): array
    {
        return [
            'name' => fake()->words(2, true),
            'sku' => strtoupper(fake()->bothify('HV-####-??')),
            'description' => fake()->sentence(),
            'price' => fake()->numberBetween(500, 50000),
            'vin_pattern' => fake()->optional()->regexify('[A-Z0-9]{3}'),
            'stock' => fake()->numberBetween(0, 50),
            'is_active' => true,
        ];
    }
}
