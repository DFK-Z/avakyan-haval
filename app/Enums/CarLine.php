<?php

namespace App\Enums;

enum CarLine: string
{
    case City = 'city';
    case Pro = 'pro';

    public function label(): string
    {
        return match ($this) {
            self::City => 'HAVAL CITY',
            self::Pro => 'HAVAL PRO',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::City => 'Городские кроссоверы и пикапы',
            self::Pro => 'Внедорожники',
        };
    }
}
