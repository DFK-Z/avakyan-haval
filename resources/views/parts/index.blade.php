<x-layout.app title="Запчасти — Haval Volgograd">
    <x-ui.page-hero
        title="Каталог запчастей"
        subtitle="Поиск совместимых деталей по VIN. Оригинальные и сертифицированные запчасти HAVAL."
        eyebrow="Оригинальные детали"
        :image="asset('images/cars/h7-hero-lg.png')"
    />
    <section class="mx-auto grid max-w-container-max grid-cols-1 items-center gap-10 px-margin-mobile py-section-gap md:px-margin-desktop lg:grid-cols-2">
        <img src="{{ asset('images/cars/h3-hero-lg.png') }}" alt="HAVAL с оригинальными компонентами" class="min-h-[300px] w-full rounded-2xl object-cover">
        <div>
            <h2 class="mb-2 text-headline-md font-semibold text-primary">Найдите деталь для вашего HAVAL</h2>
            <p class="mb-8 text-secondary">Введите VIN автомобиля, чтобы проверить совместимость.</p>
            <livewire:vin-search />
        </div>
    </section>
</x-layout.app>
