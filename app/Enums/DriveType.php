<?php

namespace App\Enums;

enum DriveType: string
{
    case Fwd = 'fwd';
    case Rwd = 'rwd';
    case Awd = 'awd';

    public function label(): string
    {
        return match ($this) {
            self::Fwd => 'Передний',
            self::Rwd => 'Задний',
            self::Awd => 'Полный',
        };
    }
}
