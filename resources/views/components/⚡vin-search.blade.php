<?php

use App\Models\Part;
use Livewire\Component;

new class extends Component
{
    public string $vin = '';

    public function search()
    {
        $this->validate([
            'vin' => ['required', 'string', 'min:11', 'max:17'],
        ]);
    }

    public function with(): array
    {
        $parts = collect();

        if (strlen($this->vin) >= 11) {
            $parts = Part::query()
                ->where('is_active', true)
                ->where('stock', '>', 0)
                ->orderBy('name')
                ->get()
                ->filter(fn (Part $part): bool => $part->matchesVin($this->vin))
                ->values();
        }

        return ['parts' => $parts];
    }
};
?>

<div class="bg-surface rounded-2xl border border-outline-variant p-6">
    <form wire:submit="search" class="flex flex-col sm:flex-row gap-3">
        <input
            type="text"
            wire:model.live.debounce.500ms="vin"
            placeholder="Введите VIN (17 символов)"
            class="flex-1 rounded-full border border-outline-variant px-5 py-3 text-sm uppercase tracking-wider"
            maxlength="17"
        >
        <button type="submit" class="bg-primary text-on-primary px-8 py-3 rounded-full font-label-sm hover:bg-primary/90 shrink-0">
            Найти
        </button>
    </form>
    @error('vin') <p class="text-sm text-red-600 mt-2">{{ $message }}</p> @enderror

    <div wire:loading class="text-label-sm text-secondary mt-4">Поиск...</div>

    @if (strlen($vin) >= 11)
        <div class="mt-6" wire:loading.remove>
            @if ($parts->isEmpty())
                <p class="text-secondary text-label-sm">Запчасти по данному VIN не найдены. Уточните номер или свяжитесь с отделом запчастей.</p>
            @else
                <p class="text-label-sm text-secondary mb-4">Найдено: {{ $parts->count() }}</p>
                <ul class="space-y-3 max-h-64 overflow-y-auto">
                    @foreach ($parts as $part)
                        <li class="flex justify-between items-center p-4 bg-surface-container-low rounded-xl text-label-sm" wire:key="part-{{ $part->id }}">
                            <div>
                                <span class="font-semibold text-primary block">{{ $part->name }}</span>
                                <span class="text-secondary">{{ $part->sku }}</span>
                            </div>
                            <span class="font-bold text-primary ml-4">{{ number_format($part->price, 0, ',', ' ') }} ₽</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif
</div>
