<x-layout.app title="Запись на сервис — HAVAL">
    <x-ui.page-hero
        title="Сервис HAVAL"
        subtitle="Запишитесь на техническое обслуживание."
        eyebrow="Официальный сервис"
        :image="asset('images/cars/h3-hero-lg.png')"
    />
    <section class="mx-auto grid max-w-container-max grid-cols-1 items-center gap-8 px-margin-mobile py-section-gap md:px-margin-desktop lg:grid-cols-2">
        <img src="{{ asset('images/cars/h7-hero-lg.png') }}" alt="HAVAL в официальном сервисе" class="min-h-[340px] w-full rounded-2xl object-cover">
        <div class="max-w-xl">
            <livewire:service-booking />
        </div>
    </section>
</x-layout.app>
