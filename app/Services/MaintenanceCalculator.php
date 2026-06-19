<?php

namespace App\Services;

use App\Models\CarModel;

class MaintenanceCalculator
{
    /**
     * @var array<string, int>
     */
    private const BASE_PRICES = [
        'haval-m6' => 7_500,
        'haval-jolion' => 8_500,
        'haval-dargo' => 9_200,
        'haval-dargo-x' => 9_800,
        'haval-f7' => 9_200,
        'haval-f7x' => 10_500,
        'gwm-poer' => 11_000,
        'haval-h3' => 8_800,
        'haval-h5' => 12_500,
        'haval-h7' => 11_800,
        'haval-h9' => 12_800,
    ];

    public function calculate(CarModel $carModel, int $mileage): int
    {
        $base = self::BASE_PRICES[$carModel->slug] ?? (int) ($carModel->price_from * 0.002);
        $mileageFactor = (int) floor($mileage / 15_000) * 1_200;

        return $base + $mileageFactor;
    }
}
