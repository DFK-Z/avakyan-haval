<?php

namespace App\Filament\Widgets;

use App\Models\CarModel;
use App\Models\Lead;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PopularModelsChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Популярные модели (по заявкам)';

    protected function getData(): array
    {
        $data = Lead::query()
            ->select('car_model_id', DB::raw('count(*) as total'))
            ->whereNotNull('car_model_id')
            ->groupBy('car_model_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $labels = [];
        $values = [];

        foreach ($data as $row) {
            $model = CarModel::query()->find($row->car_model_id);
            $labels[] = $model?->name ?? '—';
            $values[] = $row->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Заявки',
                    'data' => $values,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
