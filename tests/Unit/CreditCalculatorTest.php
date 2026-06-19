<?php

use App\Services\CreditCalculator;

test('calculates monthly payment using annuity formula', function () {
    $calculator = new CreditCalculator;

    $payment = $calculator->monthlyPayment(1_600_000, 12.5, 36);

    expect($payment)->toBeGreaterThan(0);
    expect($calculator->totalPayment($payment, 36))->toBeGreaterThan($payment);
});

test('returns zero for invalid principal', function () {
    $calculator = new CreditCalculator;

    expect($calculator->monthlyPayment(0, 12.5, 36))->toBe(0.0);
});
