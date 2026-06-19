<?php

namespace Database\Seeders;

use App\Enums\CarCategory;
use App\Enums\CarLine;
use App\Enums\DriveType;
use App\Models\Accessory;
use App\Models\CarModel;
use App\Models\CarTrim;
use App\Models\DealerLocation;
use App\Models\ServiceProgram;
use App\Models\StockVehicle;
use Illuminate\Database\Seeder;

class HavalCatalogSeeder extends Seeder
{
    /**
     * @var array<int, array<string, mixed>>
     */
    private const MODELS = [
        ['slug' => 'haval-m6', 'name' => 'M6', 'line' => CarLine::City, 'category' => CarCategory::Crossover, 'drive' => DriveType::Fwd, 'price' => 2_049_000, 'tagline' => 'Создан из преимуществ', 'year' => 2026, 'hero' => true, 'image' => 'm6-hero-lg.png', 'thumb' => 'm6.webp'],
        ['slug' => 'haval-jolion', 'name' => 'JOLION', 'line' => CarLine::City, 'category' => CarCategory::Crossover, 'drive' => DriveType::Fwd, 'price' => 2_049_000, 'tagline' => 'Кроссовер №1 в России', 'badge' => 'Обновленный', 'year' => 2026, 'popular' => true, 'hero' => true, 'image' => 'jolion-hero-lg.png', 'thumb' => 'jolion.webp'],
        ['slug' => 'haval-dargo', 'name' => 'DARGO', 'line' => CarLine::City, 'category' => CarCategory::Suv, 'drive' => DriveType::Awd, 'price' => 3_199_000, 'tagline' => 'Надежно движет вперед', 'badge' => 'Обновленный', 'year' => 2026, 'popular' => true, 'hero' => true, 'image' => 'dargo-hero-lg.png', 'thumb' => 'dargo.webp'],
        ['slug' => 'haval-dargo-x', 'name' => 'DARGO X', 'line' => CarLine::City, 'category' => CarCategory::Suv, 'drive' => DriveType::Awd, 'price' => 3_499_000, 'tagline' => 'Для любых дорог', 'year' => 2025, 'image' => 'dargo-x-hero-lg.png', 'thumb' => 'dargo-x.webp'],
        ['slug' => 'haval-f7', 'name' => 'F7', 'line' => CarLine::City, 'category' => CarCategory::Crossover, 'drive' => DriveType::Fwd, 'price' => 2_849_000, 'tagline' => 'На уровень выше', 'badge' => 'Обновленный', 'year' => 2025, 'updated' => true, 'hero' => true, 'image' => 'f7-hero-lg.png', 'thumb' => 'f7.webp'],
        ['slug' => 'haval-f7x', 'name' => 'F7x', 'line' => CarLine::City, 'category' => CarCategory::Coupe, 'drive' => DriveType::Awd, 'price' => 3_599_000, 'tagline' => 'Добавь эмоциям оборотов', 'badge' => 'Обновленный', 'year' => 2025, 'image' => 'f7x-hero-lg.png', 'thumb' => 'f7x.webp'],
        ['slug' => 'gwm-poer', 'name' => 'POER', 'line' => CarLine::City, 'category' => CarCategory::Pickup, 'drive' => DriveType::Awd, 'price' => 3_599_000, 'tagline' => 'Пикап для работы и отдыха', 'year' => 2025, 'image' => 'poer-hero-lg.png', 'thumb' => 'poer.webp'],
        ['slug' => 'haval-h3', 'name' => 'H3', 'line' => CarLine::Pro, 'category' => CarCategory::Suv, 'drive' => DriveType::Awd, 'price' => 2_499_000, 'tagline' => 'С встроенными сервисами Яндекс Авто', 'badge' => 'Обновленный', 'year' => 2026, 'hero' => true, 'image' => 'h3-hero-lg.png', 'thumb' => 'h3.webp'],
        ['slug' => 'haval-h5', 'name' => 'H5', 'line' => CarLine::Pro, 'category' => CarCategory::Suv, 'drive' => DriveType::Awd, 'price' => 4_049_000, 'tagline' => 'Премиальный внедорожник', 'year' => 2026, 'image' => 'h5-hero-lg.png', 'thumb' => 'h5.webp'],
        ['slug' => 'haval-h7', 'name' => 'H7', 'line' => CarLine::Pro, 'category' => CarCategory::Suv, 'drive' => DriveType::Awd, 'price' => 3_799_000, 'tagline' => 'Теперь с новым двигателем 231 л.с.', 'year' => 2026, 'image' => 'h7-hero-lg.png', 'thumb' => 'h7.webp'],
        ['slug' => 'haval-h9', 'name' => 'H9', 'line' => CarLine::Pro, 'category' => CarCategory::Suv, 'drive' => DriveType::Awd, 'price' => 4_699_000, 'tagline' => 'Флагман линейки PRO', 'badge' => 'Яндекс Авто', 'year' => 2026, 'popular' => true, 'image' => 'h9-hero-lg.png', 'thumb' => 'h9.webp'],
    ];

    public function run(): void
    {
        foreach (self::MODELS as $index => $data) {
            $car = CarModel::query()->updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'brand' => 'Haval',
                    'line' => $data['line'],
                    'name' => $data['name'],
                    'tagline' => $data['tagline'],
                    'badge' => $data['badge'] ?? null,
                    'category' => $data['category'],
                    'drive_type' => $data['drive'],
                    'price_from' => $data['price'],
                    'model_year' => $data['year'],
                    'transmission' => 'Автомат',
                    'seats' => 5,
                    'doors' => 5,
                    'specs' => ['Двигатель' => '2.0T', 'Привод' => $data['drive']->label()],
                    'hero_image' => '/images/cars/'.($data['image'] ?? ''),
                    'thumb_image' => '/images/cars/'.($data['thumb'] ?? $data['image'] ?? ''),
                    'is_active' => true,
                    'is_popular' => $data['popular'] ?? false,
                    'is_updated' => $data['updated'] ?? isset($data['badge']),
                    'show_in_hero' => $data['hero'] ?? false,
                    'sort_order' => $index,
                    'price_disclaimer' => 'Предложение ограничено, не является офертой. Подробности у официального дилера HAVAL Volgograd.',
                    'meta_title' => 'HAVAL '.$data['name'].' — купить в Волгограде',
                ],
            );

            CarTrim::query()->updateOrCreate(
                ['car_model_id' => $car->id, 'slug' => 'comfort'],
                ['name' => 'Комфорт', 'price' => $car->price_from, 'features' => ['Климат-контроль', 'Мультимедиа']],
            );
            CarTrim::query()->updateOrCreate(
                ['car_model_id' => $car->id, 'slug' => 'premium'],
                ['name' => 'Премиум', 'price' => $car->price_from + 280_000, 'features' => ['Панорама', 'Подогрев сидений', 'Ассистенты']],
            );

            if ($car->stockVehicles()->count() === 0) {
                StockVehicle::query()->create([
                    'car_model_id' => $car->id,
                    'color' => ['Белый', 'Чёрный', 'Серый'][$car->id % 3],
                    'price' => $car->price_from + (($car->id % 5) * 30_000),
                    'year' => $data['year'],
                    'engine' => '2.0T',
                    'drive' => $data['drive']->label(),
                    'is_available' => true,
                ]);
            }
        }

        DealerLocation::query()->updateOrCreate(
            ['name' => 'HAVAL Volgograd CITY'],
            [
                'line' => CarLine::City,
                'address' => 'г. Волгоград, ул. Дилерская, 1',
                'phone' => '+7 (844) 200-00-01',
                'email' => 'city@haval-volgograd.ru',
                'working_hours' => 'Пн–Вс: 9:00–21:00',
                'latitude' => 48.708,
                'longitude' => 44.513,
            ],
        );

        DealerLocation::query()->updateOrCreate(
            ['name' => 'HAVAL Volgograd PRO'],
            [
                'line' => CarLine::Pro,
                'address' => 'г. Волгоград, ул. Дилерская, 15',
                'phone' => '+7 (844) 200-00-02',
                'email' => 'pro@haval-volgograd.ru',
                'working_hours' => 'Пн–Вс: 9:00–21:00',
                'latitude' => 48.715,
                'longitude' => 44.520,
            ],
        );

        $programs = [
            ['name' => 'Нулевое ТО', 'slug' => 'zero-to', 'audience' => 'owners', 'icon' => 'build', 'description' => 'Первое техническое обслуживание по специальной цене для новых владельцев.'],
            ['name' => 'Сервисный контракт', 'slug' => 'service-contract', 'audience' => 'owners', 'icon' => 'description', 'description' => 'Надёжный сервис по стабильной цене на весь срок владения.'],
            ['name' => 'HAVAL Защита+', 'slug' => 'haval-protection', 'audience' => 'owners', 'icon' => 'shield', 'description' => 'Расширенная защита автомобиля и уверенность на дороге.'],
            ['name' => 'Помощь на дороге', 'slug' => 'roadside', 'audience' => 'owners', 'icon' => 'support_agent', 'description' => 'Круглосуточная поддержка при поломке или ДТП.'],
            ['name' => 'Лояльный Trade-in', 'slug' => 'loyal-trade-in', 'audience' => 'buyers', 'icon' => 'swap_horiz', 'description' => 'Выгода до 200 000 ₽ при сдаче HAVAL или Great Wall в трейд-ин.'],
        ];

        foreach ($programs as $i => $program) {
            ServiceProgram::query()->updateOrCreate(
                ['slug' => $program['slug']],
                [...$program, 'sort_order' => $i, 'is_active' => true, 'cta_label' => 'Подробнее', 'cta_url' => route('owners')],
            );
        }

        $accessories = [
            ['name' => 'Коврики салона', 'category' => 'Салон', 'price' => 8_500],
            ['name' => 'Багажник на крышу', 'category' => 'Экстерьер', 'price' => 24_000],
            ['name' => 'Защита картера', 'category' => 'Защита', 'price' => 12_500],
            ['name' => 'Моторное масло HAVAL', 'category' => 'ТО', 'price' => 4_200],
        ];

        foreach ($accessories as $i => $item) {
            Accessory::query()->updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($item['name'])],
                [...$item, 'description' => 'Оригинальный аксессуар HAVAL.', 'sort_order' => $i],
            );
        }
    }
}
