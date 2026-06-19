<x-layout.app title="Найти дилера — HAVAL Volgograd">
    <x-ui.page-hero
        title="Дилерская сеть"
        subtitle="Официальные центры HAVAL в Волгограде."
        eyebrow="HAVAL Volgograd"
        :image="asset('images/cars/haval-city-banner.png')"
    />
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap space-y-12">
        @foreach ($dealers as $line => $locations)
            <div>
                <h2 class="text-headline-md font-semibold text-primary mb-6 uppercase">{{ $line === 'city' ? 'HAVAL CITY' : 'HAVAL PRO' }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($locations as $dealer)
                        <div class="overflow-hidden rounded-2xl border border-outline-variant bg-surface">
                            <img src="{{ asset($line === 'city' ? 'images/cars/haval-city-banner.png' : 'images/cars/haval-pro-banner.png') }}" alt="" class="h-48 w-full object-cover object-center">
                            <div class="p-8">
                                <h3 class="font-bold text-primary text-headline-md">{{ $dealer->name }}</h3>
                                <p class="text-secondary mt-3">{{ $dealer->address }}, {{ $dealer->city }}</p>
                                <a href="tel:{{ preg_replace('/\D/', '', $dealer->phone) }}" class="text-primary font-semibold mt-3 block">{{ $dealer->phone }}</a>
                                @if ($dealer->email)<p class="text-label-sm text-secondary">{{ $dealer->email }}</p>@endif
                                <p class="text-label-sm text-secondary mt-2">{{ $dealer->working_hours }}</p>
                                <div class="flex gap-3 mt-6">
                                    <a href="{{ route('stock.index') }}" wire:navigate class="bg-primary text-on-primary px-5 py-2 rounded-full font-label-sm">В наличии</a>
                                    <a href="{{ route('home') }}#contact" wire:navigate class="border border-outline-variant px-5 py-2 rounded-full font-label-sm">Связаться</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>
</x-layout.app>
