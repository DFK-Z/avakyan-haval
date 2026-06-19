<?php

namespace Database\Factories;

use App\Models\Certificate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Certificate>
 */
class CertificateFactory extends Factory
{
    protected $model = Certificate::class;

    public function definition(): array
    {
        return [
            'title' => 'Сертификат '.fake()->word(),
            'image' => 'certificates/placeholder.pdf',
            'issued_at' => fake()->date(),
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
