<?php

use App\Models\CarModel;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component
{
    /** @var array<int> */
    public array $favoriteIds = [];

    public function mount(): void
    {
        if (Auth::check()) {
            $this->favoriteIds = Favorite::query()
                ->where('user_id', Auth::id())
                ->pluck('car_model_id')
                ->all();
        }
    }

    public function updatedFavoriteIds(): void
    {
        if (! Auth::check()) {
            return;
        }

        $userId = Auth::id();

        Favorite::query()->where('user_id', $userId)->delete();

        foreach ($this->favoriteIds as $carModelId) {
            Favorite::query()->create([
                'user_id' => $userId,
                'car_model_id' => $carModelId,
            ]);
        }
    }

    public function with(): array
    {
        return [
            'cars' => CarModel::query()->where('is_active', true)->orderBy('name')->get(),
            'serviceHistories' => Auth::user()?->serviceHistories()->with('carModel')->latest('performed_at')->get() ?? collect(),
        ];
    }
};
?>

<div>
<x-ui.page-hero
    title="Личный кабинет"
    subtitle="Избранные модели и история обслуживания вашего автомобиля."
    eyebrow="Мой HAVAL"
    :image="asset('images/cars/haval-pro-banner.png')"
/>
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap">
    @auth
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-surface rounded-2xl border border-outline-variant p-6">
                <h2 class="text-headline-md font-semibold mb-4">Избранные модели</h2>
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                    @foreach ($cars as $car)
                        <label class="cursor-pointer overflow-hidden rounded-xl border border-outline-variant bg-surface-container-low" wire:key="favorite-{{ $car->id }}">
                            @if ($car->hero_image)
                                <img src="{{ $car->hero_image }}" alt="" class="h-20 w-full object-cover">
                            @endif
                            <span class="flex items-center gap-3 p-3 text-label-sm">
                                <input type="checkbox" wire:model.live="favoriteIds" value="{{ $car->id }}" class="rounded border-outline-variant">
                                <span>{{ $car->brand }} {{ $car->name }}</span>
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="bg-surface rounded-2xl border border-outline-variant p-6">
                <h2 class="text-headline-md font-semibold mb-4">История обслуживания</h2>
                @forelse ($serviceHistories as $history)
                    <div class="border-b border-outline-variant py-3 last:border-0">
                        <p class="font-semibold">{{ $history->service_name }}</p>
                        <p class="text-label-sm text-secondary">
                            {{ $history->performed_at->format('d.m.Y') }} · {{ number_format($history->mileage, 0, ',', ' ') }} км
                            @if ($history->carModel) · {{ $history->carModel->name }} @endif
                        </p>
                    </div>
                @empty
                    <p class="text-secondary text-label-sm">Записей пока нет.</p>
                @endforelse
            </div>
        </div>
    @else
        <p class="text-secondary">Войдите в систему, чтобы управлять избранным и историей сервиса.</p>
        <a href="{{ route('login') }}" class="inline-block mt-4 bg-primary text-on-primary px-6 py-3 rounded-full font-label-sm">Войти</a>
    @endauth
</section>
</div>
