<?php

use App\Models\BlogPost;
use App\Models\CarModel;
use App\Models\Service;

test('services page loads', function () {
    Service::factory()->create(['is_active' => true]);

    $this->get(route('services.index'))->assertOk();
});

test('blog page loads', function () {
    BlogPost::factory()->create(['is_published' => true]);

    $this->get(route('blog.index'))->assertOk();
});

test('parts page loads', function () {
    $this->get(route('parts.index'))->assertOk();
});

test('register page loads', function () {
    $this->get(route('register'))->assertOk();
});

test('car page has forms section at bottom', function () {
    $car = CarModel::factory()->create(['is_active' => true, 'slug' => 'test-slug']);

    $this->get(route('cars.show', $car))
        ->assertOk()
        ->assertSee('Оставить заявку')
        ->assertSee('Конфигуратор');
});

test('stock and credit pages load', function () {
    CarModel::factory()->create(['is_active' => true]);

    $this->get(route('stock.index'))->assertOk();
    $this->get(route('credit'))->assertOk();
    $this->get(route('dealers.index'))->assertOk();
});
