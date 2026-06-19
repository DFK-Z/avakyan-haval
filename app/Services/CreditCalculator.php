<?php

namespace App\Services;

class CreditCalculator
{
    /**
     * Monthly payment: [P * I * (1 + I)^N] / [(1 + I)^N – 1]
     */
    public function monthlyPayment(
        float $principal,
        float $annualRatePercent,
        int $termMonths,
    ): float {
        if ($termMonths <= 0 || $principal <= 0) {
            return 0.0;
        }

        $monthlyRate = $annualRatePercent / 100 / 12;

        if ($monthlyRate <= 0) {
            return round($principal / $termMonths, 2);
        }

        $factor = (1 + $monthlyRate) ** $termMonths;

        return round(($principal * $monthlyRate * $factor) / ($factor - 1), 2);
    }

    public function totalPayment(float $monthlyPayment, int $termMonths): float
    {
        return round($monthlyPayment * $termMonths, 2);
    }
}
