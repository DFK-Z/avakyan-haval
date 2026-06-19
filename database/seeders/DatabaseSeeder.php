<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Certificate;
use App\Models\Lead;
use App\Models\Part;
use App\Models\Promotion;
use App\Models\Review;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@haval-volgograd.ru'],
            [
                'name' => 'Администратор',
                'password' => Hash::make('password'),
            ],
        );

        $this->call(HavalCatalogSeeder::class);

        Review::factory(6)->create();
        Service::factory(5)->create();
        Part::factory(10)->create();
        BlogPost::factory(3)->create();
        TeamMember::factory(4)->create();
        Certificate::factory(3)->create();
        Lead::factory(5)->create();

        Promotion::query()->updateOrCreate(
            ['slug' => 'vesennyaya-akciya'],
            [
                'title' => 'Весенняя акция',
                'description' => 'Специальные условия на покупку Haval',
                'starts_at' => now()->subDay(),
                'ends_at' => now()->addMonth(),
                'is_active' => true,
            ],
        );
    }
}
