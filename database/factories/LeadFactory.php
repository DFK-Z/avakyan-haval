<?php

namespace Database\Factories;

use App\Enums\LeadStatus;
use App\Enums\LeadType;
use App\Models\CarModel;
use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Lead>
 */
class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->optional()->safeEmail(),
            'type' => fake()->randomElement(LeadType::cases()),
            'status' => LeadStatus::New,
            'car_model_id' => CarModel::query()->inRandomOrder()->value('id'),
            'message' => fake()->optional()->sentence(),
        ];
    }
}
