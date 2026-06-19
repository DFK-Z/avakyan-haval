<?php

use App\Models\CarModel;
use App\Services\CreditCalculator;
use Livewire\Component;

new class extends Component
{
    public ?CarModel $car = null;

    public float $price = 2_000_000;

    public float $downPayment = 400_000;

    public int $termMonths = 36;

    public float $rate = 12.5;

    public function mount(?CarModel $car = null): void
    {
        $this->car = $car;

        if ($car) {
            $this->price = (float) $car->price_from;
            $this->downPayment = round($this->price * 0.2, 2);
        }
    }

    public function monthlyPayment(): float
    {
        $principal = max(0, $this->price - $this->downPayment);

        return app(CreditCalculator::class)->monthlyPayment($principal, $this->rate, $this->termMonths);
    }

    public function totalPayment(): float
    {
        return app(CreditCalculator::class)->totalPayment($this->monthlyPayment(), $this->termMonths);
    }
};
?>

<div class="bg-surface rounded-2xl border border-outline-variant p-6">
    <h3 class="text-headline-md font-semibold text-primary mb-4">Кредитный калькулятор</h3>

    <div class="space-y-4">
        <div>
            <label class="text-label-sm text-secondary">Стоимость, ₽</label>
            <input type="number" wire:model.live="price" class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2">
        </div>
        <div>
            <label class="text-label-sm text-secondary">Первоначальный взнос, ₽</label>
            <input type="number" wire:model.live="downPayment" class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2">
        </div>
        <div>
            <label class="text-label-sm text-secondary">Срок, мес. ({{ $termMonths }})</label>
            <input type="range" min="12" max="84" step="6" wire:model.live="termMonths" class="w-full accent-primary">
        </div>
        <div>
            <label class="text-label-sm text-secondary">Ставка, % ({{ $rate }})</label>
            <input type="range" min="5" max="25" step="0.5" wire:model.live="rate" class="w-full accent-primary">
        </div>
    </div>

    <div class="mt-6 p-4 bg-surface-container-low rounded-xl">
        <p class="text-label-sm text-secondary">Ежемесячный платёж</p>
        <p class="text-headline-md font-bold text-primary">{{ number_format($this->monthlyPayment(), 0, ',', ' ') }} ₽</p>
        <p class="text-label-sm text-secondary mt-2">Итого: {{ number_format($this->totalPayment(), 0, ',', ' ') }} ₽</p>
    </div>
</div>
