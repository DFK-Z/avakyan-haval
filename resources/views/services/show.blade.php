<x-layout.app :title="$service->name.' — Услуги Haval'">
    <x-ui.page-hero
        :title="$service->name"
        :subtitle="$service->description"
        eyebrow="Сервис HAVAL"
        :image="asset('images/cars/h3-hero-lg.png')"
    />
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap">
        <nav class="text-label-sm text-secondary mb-6">
            <a href="{{ route('services.index') }}" wire:navigate class="hover:text-primary">Услуги</a>
            <span> / </span>
            <span class="text-primary">{{ $service->name }}</span>
        </nav>

        @if ($service->formattedPrice())
            <p class="text-headline-md font-bold text-primary mb-4">Стоимость: {{ $service->formattedPrice() }}</p>
        @endif
        <p class="text-body-lg text-secondary max-w-2xl mb-12">Оставьте контакты, и мастер-консультант подтвердит удобное время визита и рассчитает итоговую стоимость работ.</p>

        <div class="max-w-md">
            <livewire:callback-form />
        </div>
    </section>
</x-layout.app>
