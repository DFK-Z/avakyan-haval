<x-layout.app title="Корпоративным клиентам — HAVAL">
    <x-ui.page-hero
        title="Корпоративным клиентам"
        subtitle="Поставки для бизнеса и управление автопарком."
        eyebrow="HAVAL для компаний"
        :image="asset('images/cars/haval-city-banner.png')"
    />
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <div class="bg-surface rounded-2xl p-8 border border-outline-variant">
                <h2 class="font-semibold text-primary mb-3">Корпоративные продажи</h2>
                <p class="text-secondary text-label-sm">Специальные условия при покупке от 3 автомобилей. Персональный менеджер.</p>
            </div>
            <div class="bg-surface rounded-2xl p-8 border border-outline-variant">
                <h2 class="font-semibold text-primary mb-3">Автопарк</h2>
                <p class="text-secondary text-label-sm">Подбор моделей CITY и PRO под задачи компании. Сервисное сопровождение.</p>
            </div>
        </div>
        <livewire:callback-form />
    </section>
</x-layout.app>
