@props(['car'])

<div class="group flex flex-col overflow-hidden rounded-2xl border border-outline-variant bg-surface shadow-sm">
    @php $cardImage = $car->hero_image ?? $car->thumb_image ?? $car->galleryItems->first()?->url() @endphp
    @if ($cardImage)
        <div class="h-[200px] w-full overflow-hidden bg-surface-container-low">
            <img
                src="{{ $cardImage }}"
                alt="HAVAL {{ $car->name }}"
                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
            >
        </div>
    @else
        <div class="flex h-[200px] w-full items-center justify-center bg-surface-container-low text-secondary">
            <span class="material-symbols-outlined text-4xl">directions_car</span>
        </div>
    @endif

    <div class="flex flex-1 flex-col p-6">
        <h3 class="mb-4 text-headline-md font-semibold text-primary">{{ $car->brand }} {{ $car->name }}</h3>

        <div class="mb-6 grid grid-cols-2 gap-4 text-label-sm text-secondary">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">directions_car</span>
                {{ $car->category->label() }}
            </div>
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">person</span>
                {{ $car->seats }} мест
            </div>
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">settings</span>
                {{ $car->drive_type->label() }}
            </div>
            <div class="flex items-center gap-2 font-semibold text-primary">
                от {{ $car->formattedPrice() }}
            </div>
        </div>

        <div class="mt-auto flex flex-col gap-2">
            <a href="{{ route('cars.show', $car) }}" wire:navigate class="w-full rounded-full bg-primary py-3 text-center font-label-sm text-on-primary transition-colors hover:bg-primary/90">
                О модели
            </a>
            <a href="{{ route('stock.index', ['model' => $car->slug]) }}" wire:navigate class="w-full rounded-full border border-outline-variant bg-surface py-3 text-center font-label-sm text-primary transition-colors hover:bg-surface-container-low">
                В наличии
            </a>
        </div>
    </div>
</div>
