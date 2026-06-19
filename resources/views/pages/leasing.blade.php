<x-layout.app title="Лизинг — HAVAL Volgograd">
    <x-ui.page-hero
        title="Лизинг"
        subtitle="Выгодные условия для юридических лиц и ИП."
        eyebrow="Для бизнеса"
        :image="asset('images/cars/poer-hero-lg.png')"
    />
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap max-w-3xl">
        <p class="text-secondary mb-6">Лизинг HAVAL — способ обновить автопарк без крупных единовременных затрат. Индивидуальный график платежей и налоговые преимущества.</p>
        <livewire:callback-form />
    </section>
</x-layout.app>
