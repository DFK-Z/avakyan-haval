<?php

namespace App\Enums;

enum CarCategory: string
{
    case Suv = 'suv';
    case Sedan = 'sedan';
    case Hatchback = 'hatchback';
    case Coupe = 'coupe';
    case Crossover = 'crossover';
    case Pickup = 'pickup';
    case Sport = 'sport';

    public function label(): string
    {
        return match ($this) {
            self::Suv => 'Внедорожник',
            self::Sedan => 'Седан',
            self::Hatchback => 'Хэтчбек',
            self::Coupe => 'Купе',
            self::Crossover => 'Кроссовер',
            self::Pickup => 'Пикап',
            self::Sport => 'Спорткар',
        };
    }
}
