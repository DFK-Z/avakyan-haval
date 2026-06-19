<?php

namespace App\Enums;

enum LeadType: string
{
    case TestDrive = 'test-drive';
    case Callback = 'callback';
    case Credit = 'credit';
    case TradeIn = 'trade-in';

    public function label(): string
    {
        return match ($this) {
            self::TestDrive => 'Тест-драйв',
            self::Callback => 'Обратный звонок',
            self::Credit => 'Кредит',
            self::TradeIn => 'Trade-in',
        };
    }
}
