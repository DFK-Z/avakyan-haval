<x-layout.app title="Контакты — HAVAL Volgograd">
    <x-ui.page-hero
        title="Контакты"
        :subtitle="'Горячая линия: '.config('dealer.hotline')"
        eyebrow="Дилерский центр"
        :image="asset('images/cars/f7-hero-lg.png')"
    />
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div class="space-y-6">
                @foreach (\App\Models\DealerLocation::query()->where('is_active', true)->orderBy('sort_order')->get() as $dealer)
                    <div class="bg-surface rounded-2xl p-6 border border-outline-variant">
                        <span class="text-label-xs text-secondary uppercase">{{ $dealer->line->label() }}</span>
                        <h3 class="font-semibold text-primary text-headline-md mt-1">{{ $dealer->name }}</h3>
                        <p class="text-secondary mt-2">{{ $dealer->address }}</p>
                        <a href="tel:{{ preg_replace('/\D/', '', $dealer->phone) }}" class="text-primary font-semibold mt-2 block">{{ $dealer->phone }}</a>
                        @if ($dealer->working_hours)<p class="text-label-sm text-secondary mt-1">{{ $dealer->working_hours }}</p>@endif
                    </div>
                @endforeach
            </div>
            <livewire:callback-form />
        </div>
    </section>
</x-layout.app>
