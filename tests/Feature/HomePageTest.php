<?php

use App\Models\CarModel;

test('home page loads successfully', function () {
    CarModel::factory()->popular()->create();

    $this->get(route('home'))->assertOk();
});

test('catalog page loads successfully', function () {
    CarModel::factory()->create(['is_active' => true]);

    $this->get(route('catalog'))->assertOk();
});

test('car detail page loads successfully', function () {
    $car = CarModel::factory()->create(['is_active' => true, 'slug' => 'test-car']);

    $this->get(route('cars.show', $car))->assertOk();
});
