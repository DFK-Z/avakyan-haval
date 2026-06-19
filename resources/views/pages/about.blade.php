<x-layout.app title="О бренде HAVAL">
    <x-ui.page-hero
        title="О бренде HAVAL"
        :subtitle="config('dealer.brand').' — официальный дилер в Волгограде.'"
        eyebrow="CITY / PRO"
        :image="asset('images/cars/haval-city-banner.png')"
    />
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap max-w-3xl space-y-6 text-secondary">
        <p>HAVAL — бренд кроссоверов и внедорожников в экосистеме Great Wall Motor. В России представлены линейки HAVAL CITY (городские кроссоверы) и HAVAL PRO (внедорожники).</p>
        <p>Наш дилерский центр предлагает полный цикл: продажа, кредит, trade-in, сервис и оригинальные запчасти.</p>
        <div class="flex flex-wrap gap-4">
            <a href="{{ route('dealers.index') }}" wire:navigate class="bg-primary text-on-primary px-6 py-3 rounded-full font-label-sm">Дилерская сеть</a>
            <a href="{{ route('catalog') }}" wire:navigate class="border border-outline-variant px-6 py-3 rounded-full font-label-sm">Модельный ряд</a>
        </div>
    </section>
</x-layout.app>
