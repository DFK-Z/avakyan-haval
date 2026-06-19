<x-layout.app title="Trade-in — HAVAL Volgograd">
    <x-ui.page-hero
        title="Лояльный Trade-in"
        subtitle="Выгода до 200 000 ₽ при сдаче HAVAL или Great Wall."
        eyebrow="Обновите автомобиль"
        :image="asset('images/cars/dargo-hero-lg.png')"
    />
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div class="text-secondary space-y-4 text-label-sm">
            <p>Программа «Лояльный Trade-in» — дополнительная выгода при сдаче автомобиля марки HAVAL или Great Wall с пробегом.</p>
            <ul class="list-disc pl-5 space-y-2">
                <li>Автомобиль минимум 3 месяца в собственности</li>
                <li>Принимаются автомобили с пробегом</li>
                <li>Зачёт стоимости в покупку нового HAVAL</li>
            </ul>
        </div>
        <livewire:trade-in-form />
    </section>
</x-layout.app>
