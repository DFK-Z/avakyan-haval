<x-layout.app title="Услуги — Haval Volgograd">
    <x-ui.page-hero
        title="Услуги"
        subtitle="Сервис, ТО, кузовные работы и дополнительные услуги дилерского центра."
        eyebrow="Официальный сервис"
        :image="asset('images/cars/h3-hero-lg.png')"
    />
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap">
        @php
            $serviceImages = [
                asset('images/cars/h3-hero-lg.png'),
                asset('images/cars/h7-hero-lg.png'),
                asset('images/cars/dargo-hero-lg.png'),
                asset('images/cars/f7-hero-lg.png'),
            ];
        @endphp

        @forelse ($services as $category => $items)
            <div class="mb-12">
                <h2 class="text-headline-md font-semibold text-primary mb-6">{{ $category ?: 'Общие услуги' }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($items as $service)
                        <a href="{{ route('services.show', $service) }}" wire:navigate class="group grid overflow-hidden rounded-2xl border border-outline-variant bg-surface transition-shadow hover:shadow-md sm:grid-cols-[180px_1fr]">
                            <img src="{{ $serviceImages[($loop->parent->index + $loop->index) % count($serviceImages)] }}" alt="" class="h-44 w-full object-cover sm:h-full">
                            <div class="flex items-start justify-between gap-4 p-6">
                                <div>
                                    <h3 class="font-semibold text-primary mb-2">{{ $service->name }}</h3>
                                    <p class="text-label-sm text-secondary">{{ $service->description }}</p>
                                </div>
                                @if ($service->formattedPrice())
                                    <span class="font-bold text-primary whitespace-nowrap">{{ $service->formattedPrice() }}</span>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @empty
            <p class="text-secondary">Список услуг обновляется.</p>
        @endforelse

        <div class="mt-16 max-w-2xl mx-auto">
            <h2 class="text-headline-md font-semibold text-primary mb-4 text-center">Запчасти по VIN</h2>
            <livewire:vin-search />
        </div>
    </section>
</x-layout.app>
