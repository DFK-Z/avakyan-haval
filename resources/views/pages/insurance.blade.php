<x-layout.app title="Страхование — HAVAL Volgograd">
    <x-ui.page-hero
        title="Страхование"
        subtitle="КАСКО и ОСАГО для вашего HAVAL."
        eyebrow="Уверенность на дороге"
        :image="asset('images/cars/jolion-hero-lg.png')"
    />
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap max-w-3xl">
        <p class="text-secondary mb-6">Поможем подобрать оптимальную программу страхования при покупке автомобиля. Оформление в дилерском центре — без визита в страховую компанию.</p>
        <livewire:callback-form />
    </section>
</x-layout.app>
