<x-ui.page-hero
    title="Автопарк HAVAL"
    subtitle="Фильтруйте модели по цене, типу кузова и приводу в реальном времени."
    eyebrow="CITY / PRO"
    :image="asset('images/cars/haval-city-banner.png')"
/>

<section class="mx-auto max-w-container-max px-margin-mobile py-12 md:px-margin-desktop md:py-16">
    <div class="bg-surface rounded-2xl border border-outline-variant p-6 mb-8 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="block text-label-sm text-secondary mb-2">Макс. цена, ₽</label>
            <input type="range" min="1500000" max="4500000" step="50000" wire:model.live="priceMax"
                class="w-full accent-primary">
            <p class="text-label-sm mt-1">{{ $priceMax ? number_format($priceMax, 0, ',', ' ') : 'Любая' }} ₽</p>
        </div>
        <div>
            <label class="block text-label-sm text-secondary mb-2">Тип кузова</label>
            <select wire:model.live="category" class="w-full rounded-lg border-outline-variant bg-surface">
                <option value="">Все</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->value }}">{{ $cat->label() }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-label-sm text-secondary mb-2">Привод</label>
            <select wire:model.live="drive" class="w-full rounded-lg border-outline-variant bg-surface">
                <option value="">Все</option>
                @foreach ($drives as $d)
                    <option value="{{ $d->value }}">{{ $d->label() }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div wire:loading.class="opacity-50" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($cars as $car)
            <x-ui.car-card :car="$car" />
        @empty
            <p class="col-span-full text-secondary text-center py-12">По выбранным фильтрам автомобили не найдены.</p>
        @endforelse
    </div>
</section>
