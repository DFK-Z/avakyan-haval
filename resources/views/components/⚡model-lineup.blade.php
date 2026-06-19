<?php

use App\Enums\CarLine;
use App\Models\CarModel;
use Livewire\Component;

new class extends Component
{
    public string $line = 'city';

    public function with(): array
    {
        return [
            'models' => CarModel::query()
                ->with('galleryItems')
                ->where('is_active', true)
                ->where('line', $this->line)
                ->orderBy('sort_order')
                ->get(),
            'cityCount' => CarModel::query()->where('is_active', true)->where('line', CarLine::City)->count(),
            'proCount' => CarModel::query()->where('is_active', true)->where('line', CarLine::Pro)->count(),
        ];
    }
};
?>

<div>
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap">
        <div class="flex flex-col sm:flex-row gap-4 mb-8">
            <button type="button" wire:click="$set('line', 'city')" @class([
                'px-6 py-3 rounded-full font-label-sm border transition-colors',
                'bg-primary text-on-primary border-primary' => $line === 'city',
                'bg-surface border-outline-variant text-primary hover:bg-surface-container-low' => $line !== 'city',
            ])>
                HAVAL CITY ({{ $cityCount }})
            </button>
            <button type="button" wire:click="$set('line', 'pro')" @class([
                'px-6 py-3 rounded-full font-label-sm border transition-colors',
                'bg-primary text-on-primary border-primary' => $line === 'pro',
                'bg-surface border-outline-variant text-primary hover:bg-surface-container-low' => $line !== 'pro',
            ])>
                HAVAL PRO ({{ $proCount }})
            </button>
        </div>

        <div wire:loading.class="opacity-50" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($models as $car)
                <div class="bg-surface rounded-2xl border border-outline-variant overflow-hidden flex flex-col" wire:key="lineup-{{ $car->id }}">
                    @if ($car->thumb_image ?? $car->hero_image)
                        <div class="bg-surface-container-low flex items-center justify-center h-[160px] overflow-hidden">
                            <img src="{{ $car->thumb_image ?? $car->hero_image }}" alt="HAVAL {{ $car->name }}" class="h-[140px] w-auto object-contain">
                        </div>
                    @endif
                    <div class="p-6 pb-0">
                        @if ($car->badge)
                            <span class="text-label-xs text-secondary uppercase tracking-wide">{{ $car->badge }}</span>
                        @endif
                        <h3 class="text-headline-md font-bold text-primary mt-1">HAVAL {{ $car->name }}</h3>
                        @if ($car->tagline)
                            <p class="text-label-sm text-secondary mt-2 line-clamp-2">{{ $car->tagline }}</p>
                        @endif
                        <p class="text-primary font-bold mt-4">от {{ $car->formattedPrice() }}</p>
                        @if ($car->model_year)
                            <p class="text-label-xs text-secondary mt-1">{{ $car->model_year }} модельного года</p>
                        @endif
                    </div>
                    <div class="p-6 pt-4 mt-auto flex flex-col gap-2">
                        <a href="{{ route('cars.show', $car) }}" wire:navigate class="w-full text-center bg-primary text-on-primary py-2.5 rounded-full font-label-sm">О модели</a>
                        <a href="{{ route('stock.index', ['model' => $car->slug]) }}" wire:navigate class="w-full text-center border border-outline-variant py-2.5 rounded-full font-label-sm hover:bg-surface-container-low">В наличии</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>
