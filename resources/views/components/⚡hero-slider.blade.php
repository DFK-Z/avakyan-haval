<?php

use App\Models\CarModel;
use Livewire\Component;

new class extends Component
{
    public int $slide = 0;

    public function with(): array
    {
        return [
            'slides' => CarModel::query()
                ->where('is_active', true)
                ->where('show_in_hero', true)
                ->orderBy('sort_order')
                ->get(),
        ];
    }

    public function next(): void
    {
        $count = CarModel::query()->where('show_in_hero', true)->where('is_active', true)->count();
        if ($count > 0) {
            $this->slide = ($this->slide + 1) % $count;
        }
    }

    public function prev(): void
    {
        $count = CarModel::query()->where('show_in_hero', true)->where('is_active', true)->count();
        if ($count > 0) {
            $this->slide = ($this->slide - 1 + $count) % $count;
        }
    }
};
?>

<div>
    @if ($slides->isNotEmpty())
        <section class="relative min-h-[560px] overflow-hidden bg-primary text-on-primary sm:min-h-[620px]">
            @foreach ($slides as $index => $car)
                <div
                    wire:key="slide-{{ $car->id }}"
                    class="absolute inset-0 transition-opacity duration-700 {{ $slide === $index ? 'z-10 opacity-100' : 'pointer-events-none z-0 opacity-0' }}"
                >
                    @if ($car->hero_image)
                        <img
                            src="{{ $car->hero_image }}"
                            alt="HAVAL {{ $car->name }}"
                            class="absolute inset-0 h-full w-full object-cover object-center"
                        >
                    @endif
                    <div class="absolute inset-0 bg-linear-to-r from-black/90 via-black/60 to-black/15"></div>
                    <div class="relative mx-auto flex min-h-[560px] max-w-container-max items-end px-margin-mobile pb-16 pt-24 md:px-margin-desktop sm:min-h-[620px] sm:items-center sm:py-16">
                        <div class="max-w-[520px]">
                            @if ($car->badge)
                                <span class="mb-5 inline-block rounded-full border border-white/30 px-3 py-1 text-xs uppercase tracking-widest text-white/75 backdrop-blur-sm">
                                    {{ $car->badge }}
                                </span>
                            @endif

                            <h2 class="mb-3 text-[clamp(2.2rem,5vw,3.8rem)] font-bold leading-tight tracking-[-0.02em] text-white">
                                HAVAL {{ $car->name }}
                            </h2>

                            @if ($car->tagline)
                                <p class="mb-5 max-w-xs text-base leading-relaxed text-white/80">
                                    {{ $car->tagline }}
                                </p>
                            @endif

                            <p class="mb-8 text-[1.6rem] font-bold text-white">
                                от {{ $car->formattedPrice() }}
                            </p>

                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('cars.show', $car) }}" wire:navigate
                                   class="rounded-full bg-white px-7 py-3 text-sm font-semibold text-black transition-colors hover:bg-white/90">
                                    Подробнее
                                </a>
                                <a href="{{ route('stock.index', ['model' => $car->slug]) }}" wire:navigate
                                   class="rounded-full border border-white/40 bg-black/10 px-7 py-3 text-sm text-white backdrop-blur-sm transition-colors hover:bg-white/10">
                                    В наличии
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @if ($slides->count() > 1)
                <button type="button" wire:click="prev"
                        class="absolute left-3 top-1/2 z-20 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-white/20 bg-white/10 text-white backdrop-blur-sm transition-colors hover:bg-white/20">
                    <span class="material-symbols-outlined text-[20px]">chevron_left</span>
                </button>
                <button type="button" wire:click="next"
                        class="absolute right-3 top-1/2 z-20 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-white/20 bg-white/10 text-white backdrop-blur-sm transition-colors hover:bg-white/20">
                    <span class="material-symbols-outlined text-[20px]">chevron_right</span>
                </button>

                <div class="absolute bottom-5 left-0 right-0 z-20 flex justify-center gap-2">
                    @foreach ($slides as $index => $car)
                        <button
                            type="button"
                            wire:click="$set('slide', {{ $index }})"
                            class="rounded-full transition-all duration-300
                                {{ $slide === $index ? 'w-7 h-2 bg-white' : 'w-2 h-2 bg-white/35 hover:bg-white/60' }}"
                        ></button>
                    @endforeach
                </div>

                <div class="absolute bottom-4 right-5 z-20 select-none font-mono text-xs tabular-nums text-white/60">
                    {{ str_pad($slide + 1, 2, '0', STR_PAD_LEFT) }}&thinsp;/&thinsp;{{ str_pad($slides->count(), 2, '0', STR_PAD_LEFT) }}
                </div>
            @endif
        </section>
    @endif
</div>
