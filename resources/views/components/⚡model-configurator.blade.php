<?php

use App\Models\CarModel;
use Livewire\Component;

new class extends Component
{
    public CarModel $car;

    public ?int $trimId = null;

    public string $color = 'Белый';

    public function mount(CarModel $car): void
    {
        $this->car = $car->load('trims');
        $this->trimId = $car->trims->first()?->id;
    }

    public function selectedTrim()
    {
        return $this->car->trims->firstWhere('id', $this->trimId);
    }

    public function totalPrice(): int
    {
        $trim = $this->selectedTrim();

        return $trim?->price ?? $this->car->price_from;
    }
};
?>

<div class="bg-surface rounded-2xl border border-outline-variant p-6">
    <h3 class="text-headline-md font-semibold text-primary mb-4">Конфигуратор {{ $car->name }}</h3>

    <div class="space-y-6">
        <div>
            <label class="text-label-sm text-secondary block mb-2">Комплектация</label>
            <div class="space-y-2">
                @foreach ($car->trims as $trim)
                    <label class="flex items-center gap-3 p-4 rounded-xl border cursor-pointer transition-colors {{ $trimId === $trim->id ? 'border-primary bg-surface-container-low' : 'border-outline-variant' }}">
                        <input type="radio" wire:model.live="trimId" value="{{ $trim->id }}" class="accent-primary">
                        <div class="flex-1">
                            <span class="font-semibold text-primary">{{ $trim->name }}</span>
                            @if ($trim->features)
                                <p class="text-label-sm text-secondary">{{ collect($trim->features)->take(3)->implode(' · ') }}</p>
                            @endif
                        </div>
                        <span class="font-bold text-primary">{{ $trim->formattedPrice() }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div>
            <label class="text-label-sm text-secondary block mb-2">Цвет кузова</label>
            <select wire:model.live="color" class="w-full rounded-lg border-outline-variant">
                @foreach (['Белый', 'Чёрный', 'Серый', 'Синий', 'Красный'] as $c)
                    <option value="{{ $c }}">{{ $c }}</option>
                @endforeach
            </select>
        </div>

        <div class="p-4 bg-surface-container-low rounded-xl">
            <p class="text-label-sm text-secondary">Итоговая стоимость</p>
            <p class="text-headline-md font-bold text-primary">{{ number_format($this->totalPrice(), 0, ',', ' ') }} ₽</p>
            <p class="text-label-xs text-secondary mt-2">Цвет: {{ $color }}. Точная цена уточняется у дилера.</p>
        </div>

        <a href="{{ route('cars.show', $car) }}#forms" wire:navigate class="block w-full text-center bg-primary text-on-primary py-3 rounded-full font-label-sm">
            Получить предложение
        </a>
    </div>
</div>
