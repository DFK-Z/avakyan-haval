<?php

namespace App\Filament\Widgets;

use App\Enums\LeadStatus;
use App\Models\Lead;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class NewLeadsToday extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $today = Lead::query()->whereDate('created_at', today())->count();
        $completed = Lead::query()->where('status', LeadStatus::Completed)->count();

        return [
            Stat::make('Заявки сегодня', (string) $today)
                ->description('Новые заявки за сегодня')
                ->color('success'),
            Stat::make('Завершённые сделки', (string) $completed)
                ->description('Успешно обработанные заявки'),
        ];
    }
}
