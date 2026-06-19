<x-layout.app title="Кредит — HAVAL Volgograd">
    <x-ui.page-hero
        title="HAVAL Кредит"
        subtitle="Кредит со сниженной процентной ставкой от банков-партнёров."
        eyebrow="Финансовые программы"
        :image="asset('images/cars/f7-hero-lg.png')"
    />
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div class="prose text-secondary max-w-none">
            <p>Оформите автокредит на покупку HAVAL в дилерском центре Волгограда. Минимальный пакет документов, решение в день обращения.</p>
            <ul class="space-y-2 text-label-sm">
                <li>Ставки от 11.9% годовых</li>
                <li>Срок до 7 лет</li>
                <li>Первый взнос от 0%</li>
                <li>Trade-in в зачёт первоначального взноса</li>
            </ul>
        </div>
        <livewire:benefit-calculator />
    </section>
</x-layout.app>
