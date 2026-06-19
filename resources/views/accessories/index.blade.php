<x-layout.app title="Аксессуары — HAVAL">
    <x-ui.page-hero
        title="Аксессуары"
        subtitle="Оригинальные аксессуары и моторное масло HAVAL."
        eyebrow="Оригинальная коллекция"
        :image="asset('images/cars/jolion-hero-lg.png')"
    />
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap">
        @php
            $accessoryImages = [
                asset('images/cars/jolion-hero-lg.png'),
                asset('images/cars/dargo-x-hero-lg.png'),
                asset('images/cars/h3-hero-lg.png'),
                asset('images/cars/f7-hero-lg.png'),
            ];
        @endphp
        @foreach ($accessories as $category => $items)
            <div class="mb-12">
                <h2 class="text-headline-md font-semibold text-primary mb-6">{{ $category ?: 'Каталог' }}</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach ($items as $item)
                        <article class="overflow-hidden rounded-xl border border-outline-variant bg-surface">
                            <img src="{{ $item->image ?: $accessoryImages[($loop->parent->index + $loop->index) % count($accessoryImages)] }}" alt="" class="h-36 w-full object-cover">
                            <div class="p-6">
                                <h3 class="font-semibold text-primary">{{ $item->name }}</h3>
                                <p class="text-label-sm text-secondary mt-2">{{ $item->description }}</p>
                                @if ($item->price)
                                    <p class="font-bold text-primary mt-4">{{ number_format($item->price, 0, ',', ' ') }} ₽</p>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>
</x-layout.app>
