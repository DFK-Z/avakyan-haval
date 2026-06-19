<?php

use App\Services\CreditCalculator;
use Livewire\Component;

new class extends Component
{
    public float $price = 2_500_000;

    public float $tradeInValue = 0;

    public float $downPayment = 300_000;

    public int $termMonths = 48;

    public float $rate = 11.9;

    public function monthlyPayment(): float
    {
        $principal = max(0, $this->price - $this->tradeInValue - $this->downPayment);

        return app(CreditCalculator::class)->monthlyPayment($principal, $this->rate, $this->termMonths);
    }

    public function totalBenefit(): float
    {
        return $this->tradeInValue;
    }
};
?>

<div class="bg-surface rounded-2xl border border-outline-variant p-6">
    <h3 class="text-headline-md font-semibold text-primary mb-4">Калькулятор выгод</h3>
    <p class="text-label-sm text-secondary mb-6">Рассчитайте кредит с учётом trade-in и первоначального взноса.</p>

    <div class="space-y-4">
        <div>
            <label class="text-label-sm text-secondary">Стоимость авто, ₽</label>
            <input type="number" wire:model.live="price" class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2">
        </div>
        <div>
            <label class="text-label-sm text-secondary">Оценка trade-in, ₽</label>
            <input type="number" wire:model.live="tradeInValue" class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2">
        </div>
        <div>
            <label class="text-label-sm text-secondary">Первый взнос, ₽</label>
            <input type="number" wire:model.live="downPayment" class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2">
        </div>
        <div>
            <label class="text-label-sm text-secondary">Срок: {{ $termMonths }} мес.</label>
            <input type="range" min="12" max="84" step="6" wire:model.live="termMonths" class="w-full accent-primary">
        </div>
        <div>
            <label class="text-label-sm text-secondary">Ставка: {{ $rate }}%</label>
            <input type="range" min="5" max="20" step="0.1" wire:model.live="rate" class="w-full accent-primary">
        </div>
    </div>

    <div class="mt-6 p-4 bg-surface-container-low rounded-xl space-y-2">
        @if ($tradeInValue > 0)
            <p class="text-label-sm text-secondary">Выгода trade-in: <span class="text-primary font-semibold">{{ number_format($totalBenefit(), 0, ',', ' ') }} ₽</span></p>
        @endif
        <p class="text-label-sm text-secondary">Ежемесячный платёж</p>
        <p class="text-headline-md font-bold text-primary">{{ number_format($this->monthlyPayment(), 0, ',', ' ') }} ₽</p>
    </div>
</div>
