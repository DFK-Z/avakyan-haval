<footer class="bg-surface-container-low text-on-surface w-full py-section-gap px-margin-mobile md:px-margin-desktop flex flex-col md:flex-row justify-between gap-gutter mt-section-gap border-t border-outline-variant">
    <div class="flex flex-col gap-stack-lg max-w-[300px]">
        <a href="{{ route('home') }}" wire:navigate class="text-headline-md font-bold text-primary">Haval Volgograd</a>
        <p class="text-on-surface-variant">Официальный дилер Haval в Волгограде с 2020 года.</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-gutter flex-1 max-w-[800px]">
        <div class="flex flex-col gap-stack-sm">
            <h4 class="font-bold mb-2">Автомобили</h4>
            <a href="{{ route('catalog') }}" wire:navigate class="text-label-sm text-on-surface-variant hover:text-primary">Автопарк</a>
            <a href="{{ route('catalog') }}" wire:navigate class="text-label-sm text-on-surface-variant hover:text-primary">Кредит и trade-in</a>
        </div>
        <div class="flex flex-col gap-stack-sm">
            <h4 class="font-bold mb-2">Сервис</h4>
            <a href="{{ route('services.index') }}" wire:navigate class="text-label-sm text-on-surface-variant hover:text-primary">Услуги</a>
            <a href="{{ route('parts.index') }}" wire:navigate class="text-label-sm text-on-surface-variant hover:text-primary">Запчасти по VIN</a>
            <a href="{{ route('blog.index') }}" wire:navigate class="text-label-sm text-on-surface-variant hover:text-primary">Блог</a>
        </div>
        <div class="flex flex-col gap-stack-sm">
            <h4 class="font-bold mb-2">Контакты</h4>
            <a href="{{ config('dealer.hotline_href') }}" class="text-label-sm text-on-surface-variant hover:text-primary">{{ config('dealer.hotline') }}</a>
            <p class="text-label-sm text-on-surface-variant">г. Волгоград</p>
            <a href="{{ route('contacts') }}" wire:navigate class="text-label-sm text-on-surface-variant hover:text-primary">Все контакты</a>
        </div>
        <div class="flex flex-col gap-stack-sm">
            <h4 class="font-bold mb-2">Мы в сети</h4>
            <div class="flex gap-3">
                <a href="#" class="p-2 bg-primary text-on-primary rounded-full hover:bg-primary/80" aria-label="VK"><span class="text-label-sm font-bold">VK</span></a>
                <a href="#" class="p-2 bg-primary text-on-primary rounded-full hover:bg-primary/80" aria-label="Telegram"><span class="text-label-sm font-bold">TG</span></a>
            </div>
        </div>
    </div>
</footer>

<div class="bg-surface-container-low border-t border-outline-variant py-6 px-margin-mobile md:px-margin-desktop text-center md:text-left flex flex-col md:flex-row justify-between items-center gap-4">
    <p class="text-label-sm text-on-surface-variant">© {{ date('Y') }} Haval Volgograd. Все права защищены.</p>
    @guest
        <a href="{{ route('register') }}" class="text-label-sm text-on-surface-variant hover:text-primary">Регистрация</a>
    @endguest
</div>
