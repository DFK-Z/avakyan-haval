<x-layout.app title="Специальные предложения — HAVAL">
    <x-ui.page-hero
        title="Специальные предложения"
        subtitle="Актуальные акции дилерского центра."
        eyebrow="Выгоды HAVAL"
        :image="asset('images/cars/dargo-hero-lg.png')"
    />
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse ($promotions as $promotion)
                <article class="overflow-hidden rounded-2xl border border-outline-variant bg-surface">
                    <img src="{{ $promotion->banner_path ?: asset('images/cars/dargo-hero-lg.png') }}" alt="" class="h-60 w-full object-cover object-center">
                    <div class="p-8">
                        <h2 class="text-headline-md font-semibold text-primary mb-3">{{ $promotion->title }}</h2>
                        <p class="text-secondary mb-4">{{ $promotion->description }}</p>
                        @if ($promotion->ends_at)
                            <p class="text-label-sm text-secondary">Действует до {{ $promotion->ends_at->format('d.m.Y') }}</p>
                        @endif
                        <a href="{{ route('catalog') }}" wire:navigate class="inline-block mt-4 text-primary font-label-sm hover:underline">Выбрать автомобиль</a>
                    </div>
                </article>
            @empty
                <p class="text-secondary col-span-full">Сейчас нет активных акций. Следите за обновлениями.</p>
            @endforelse
        </div>
    </section>
</x-layout.app>
