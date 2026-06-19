<x-ui.page-hero
    title="Автомобили в наличии"
    subtitle="Готовые к выдаче автомобили HAVAL в Волгограде."
    eyebrow="Дилерский склад"
    :image="asset('images/cars/haval-pro-banner.png')"
/>

<section class="mx-auto max-w-container-max px-margin-mobile py-12 md:px-margin-desktop md:py-16">
    <div class="bg-surface rounded-2xl border border-outline-variant p-6 mb-8 grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="text-label-sm text-secondary block mb-2">Модель</label>
            <select wire:model.live="model" class="w-full rounded-lg border-outline-variant">
                <option value="">Все модели</option>
                @foreach ($models as $m)
                    <option value="{{ $m->slug }}">HAVAL {{ $m->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="text-label-sm text-secondary block mb-2">Линейка</label>
            <select wire:model.live="line" class="w-full rounded-lg border-outline-variant">
                <option value="">CITY и PRO</option>
                <option value="city">HAVAL CITY</option>
                <option value="pro">HAVAL PRO</option>
            </select>
        </div>
    </div>

    <div wire:loading.class="opacity-50" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($vehicles as $vehicle)
            <div class="flex flex-col overflow-hidden rounded-2xl border border-outline-variant bg-surface" wire:key="stock-{{ $vehicle->id }}">
                @if ($vehicle->carModel->hero_image)
                    <img src="{{ $vehicle->carModel->hero_image }}" alt="HAVAL {{ $vehicle->carModel->name }}" class="h-[190px] w-full object-cover">
                @endif
                <div class="flex flex-1 flex-col p-6">
                <div class="mb-4 flex items-start justify-between gap-4">
                    <div>
                        <h3 class="font-bold text-primary text-headline-md">HAVAL {{ $vehicle->carModel->name }}</h3>
                        @if ($vehicle->carTrim)
                            <p class="text-label-sm text-secondary">{{ $vehicle->carTrim->name }}</p>
                        @endif
                    </div>
                    <span class="bg-surface-container-low text-label-xs px-3 py-1 rounded-full">{{ $vehicle->year }}</span>
                </div>
                <ul class="text-label-sm text-secondary space-y-1 mb-4 flex-1">
                    @if ($vehicle->color)<li>Цвет: {{ $vehicle->color }}</li>@endif
                    @if ($vehicle->engine)<li>{{ $vehicle->engine }}</li>@endif
                    @if ($vehicle->drive)<li>{{ $vehicle->drive }}</li>@endif
                    @if ($vehicle->vin)<li class="font-mono text-xs">VIN: …{{ substr($vehicle->vin, -6) }}</li>@endif
                </ul>
                <p class="text-headline-md font-bold text-primary mb-4">{{ $vehicle->formattedPrice() }}</p>
                <a href="{{ route('cars.show', $vehicle->carModel) }}#forms" wire:navigate class="w-full text-center bg-primary text-on-primary py-3 rounded-full font-label-sm">
                    Забронировать
                </a>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-secondary py-12">Нет автомобилей по выбранным фильтрам. Оставьте заявку — подберём под заказ.</p>
        @endforelse
    </div>
</section>
