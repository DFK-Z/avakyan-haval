<?php

namespace App\Enums;

enum LeadStatus: string
{
    case New = 'new';
    case InProgress = 'in-progress';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::New => 'Новая',
            self::InProgress => 'В работе',
            self::Completed => 'Завершена',
            self::Cancelled => 'Отменена',
        };
    }
}
