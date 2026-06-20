@php
    $cityModels = \App\Models\CarModel::query()->where('is_active', true)->where('line', 'city')->orderBy('sort_order')->get();
    $proModels = \App\Models\CarModel::query()->where('is_active', true)->where('line', 'pro')->orderBy('sort_order')->get();
@endphp

<nav class="bg-surface/95 backdrop-blur-md fixed top-8 left-0 w-full z-50 border-b border-outline-variant" x-data="{ modelsOpen: false, buyersOpen: false, ownersOpen: false, mobileMenuOpen: false }">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop flex justify-between items-center py-4">
        <a href="{{ route('home') }}" wire:navigate class="text-headline-md font-bold text-primary tracking-tight shrink-0 flex gap-1">
            <div class="">ЮМА</div>
            <div class="bg-emerald-500 flex items-center text-white pl-1 pr-1" style="font-size:70%">CITY</div>
            <div class="">HAVAL</div>
        </a>

        {{-- Десктопное меню --}}
        <div class="hidden xl:flex items-center gap-1">
            {{-- Модели --}}
            <div class="relative" @mouseenter="modelsOpen = true" @mouseleave="modelsOpen = false">
                <button type="button" class="font-label-sm text-primary px-3 py-2 flex items-center gap-1 hover:bg-surface-container-low rounded-lg">
                    Модели
                    <span class="material-symbols-outlined text-[18px]">expand_more</span>
                </button>
                <div x-show="modelsOpen" x-cloak class="absolute left-0 top-full pt-2 w-[640px]">
                    <div class="bg-surface border border-outline-variant rounded-2xl shadow-xl p-6 grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-label-xs font-semibold text-secondary uppercase mb-3">HAVAL CITY</p>
                            <ul class="space-y-2">
                                @foreach ($cityModels as $m)
                                    <li><a href="{{ route('cars.show', $m) }}" wire:navigate class="text-label-sm hover:text-primary font-medium">HAVAL {{ $m->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <p class="text-label-xs font-semibold text-secondary uppercase mb-3">HAVAL PRO</p>
                            <ul class="space-y-2">
                                @foreach ($proModels as $m)
                                    <li><a href="{{ route('cars.show', $m) }}" wire:navigate class="text-label-sm hover:text-primary font-medium">HAVAL {{ $m->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Покупателям --}}
            <div class="relative" @mouseenter="buyersOpen = true" @mouseleave="buyersOpen = false">
                <button type="button" class="font-label-sm text-secondary px-3 py-2 flex items-center gap-1 hover:text-primary hover:bg-surface-container-low rounded-lg">
                    Покупателям
                    <span class="material-symbols-outlined text-[18px]">expand_more</span>
                </button>
                <div x-show="buyersOpen" x-cloak class="absolute left-0 top-full pt-2 w-56">
                    <div class="bg-surface border border-outline-variant rounded-xl shadow-lg p-2">
                        <a href="{{ route('stock.index') }}" wire:navigate class="block px-4 py-2 text-label-sm rounded-lg hover:bg-surface-container-low">В наличии</a>
                        <a href="{{ route('offers.index') }}" wire:navigate class="block px-4 py-2 text-label-sm rounded-lg hover:bg-surface-container-low">Спецпредложения</a>
                        <a href="{{ route('credit') }}" wire:navigate class="block px-4 py-2 text-label-sm rounded-lg hover:bg-surface-container-low">Кредит</a>
                        <a href="{{ route('insurance') }}" wire:navigate class="block px-4 py-2 text-label-sm rounded-lg hover:bg-surface-container-low">Страхование</a>
                        <a href="{{ route('leasing') }}" wire:navigate class="block px-4 py-2 text-label-sm rounded-lg hover:bg-surface-container-low">Лизинг</a>
                        <a href="{{ route('trade-in') }}" wire:navigate class="block px-4 py-2 text-label-sm rounded-lg hover:bg-surface-container-low">Trade-in</a>
                        <a href="{{ route('corporate') }}" wire:navigate class="block px-4 py-2 text-label-sm rounded-lg hover:bg-surface-container-low">Корпоративным</a>
                        <a href="{{ route('dealers.index') }}" wire:navigate class="block px-4 py-2 text-label-sm rounded-lg hover:bg-surface-container-low">Найти дилера</a>
                    </div>
                </div>
            </div>

            {{-- Владельцам --}}
            <div class="relative" @mouseenter="ownersOpen = true" @mouseleave="ownersOpen = false">
                <button type="button" class="font-label-sm text-secondary px-3 py-2 flex items-center gap-1 hover:text-primary hover:bg-surface-container-low rounded-lg">
                    Владельцам
                    <span class="material-symbols-outlined text-[18px]">expand_more</span>
                </button>
                <div x-show="ownersOpen" x-cloak class="absolute left-0 top-full pt-2 w-56">
                    <div class="bg-surface border border-outline-variant rounded-xl shadow-lg p-2">
                        <a href="{{ route('owners') }}" wire:navigate class="block px-4 py-2 text-label-sm rounded-lg hover:bg-surface-container-low">Сервисные программы</a>
                        <a href="{{ route('service.index') }}" wire:navigate class="block px-4 py-2 text-label-sm rounded-lg hover:bg-surface-container-low">Запись на сервис</a>
                        <a href="{{ route('parts.index') }}" wire:navigate class="block px-4 py-2 text-label-sm rounded-lg hover:bg-surface-container-low">Запчасти по VIN</a>
                        <a href="{{ route('accessories.index') }}" wire:navigate class="block px-4 py-2 text-label-sm rounded-lg hover:bg-surface-container-low">Аксессуары</a>
                    </div>
                </div>
            </div>

            <a href="{{ route('about') }}" wire:navigate class="font-label-sm text-secondary px-3 py-2 hover:text-primary">О бренде</a>
            <a href="{{ route('blog.index') }}" wire:navigate class="font-label-sm text-secondary px-3 py-2 hover:text-primary">Новости</a>
            @auth
                <a href="{{ route('account') }}" wire:navigate class="font-label-sm text-secondary px-3 py-2 hover:text-primary">Кабинет</a>
            @else
                <a href="{{ route('login') }}" wire:navigate class="font-label-sm text-secondary px-3 py-2 hover:text-primary">Вход</a>
            @endauth
        </div>

        <a href="{{ route('home') }}#contact" wire:navigate class="hidden lg:inline-flex bg-primary text-on-primary px-5 py-2.5 rounded-full font-label-sm hover:bg-primary/90 shrink-0">
            Связаться
        </a>

        {{-- Кнопка бургера --}}
        <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" class="xl:hidden p-2 text-primary" aria-label="Меню">
            <span class="material-symbols-outlined">menu</span>
        </button>
    </div>

    {{-- Мобильное меню --}}
    <div x-show="mobileMenuOpen" x-cloak class="xl:hidden absolute top-full left-0 w-full bg-surface border-b border-outline-variant shadow-xl">
        <div class="px-4 py-6 space-y-4 max-h-[80vh] overflow-y-auto">
            {{-- Модели --}}
            <div>
                <button @click="modelsOpen = !modelsOpen" class="flex items-center justify-between w-full font-label-sm text-primary px-3 py-2 hover:bg-surface-container-low rounded-lg">
                    Модели
                    <span class="material-symbols-outlined text-[18px]" :class="modelsOpen ? 'rotate-180' : ''">expand_more</span>
                </button>
                <div x-show="modelsOpen" x-cloak class="pl-4 space-y-2">
                    <p class="text-label-xs font-semibold text-secondary uppercase mt-2">HAVAL CITY</p>
                    @foreach ($cityModels as $m)
                        <a href="{{ route('cars.show', $m) }}" wire:navigate class="block text-label-sm px-3 py-1.5 hover:bg-surface-container-low rounded-lg">HAVAL {{ $m->name }}</a>
                    @endforeach
                    <p class="text-label-xs font-semibold text-secondary uppercase mt-2">HAVAL PRO</p>
                    @foreach ($proModels as $m)
                        <a href="{{ route('cars.show', $m) }}" wire:navigate class="block text-label-sm px-3 py-1.5 hover:bg-surface-container-low rounded-lg">HAVAL {{ $m->name }}</a>
                    @endforeach
                </div>
            </div>

            {{-- Покупателям --}}
            <div>
                <button @click="buyersOpen = !buyersOpen" class="flex items-center justify-between w-full font-label-sm text-secondary px-3 py-2 hover:text-primary hover:bg-surface-container-low rounded-lg">
                    Покупателям
                    <span class="material-symbols-outlined text-[18px]" :class="buyersOpen ? 'rotate-180' : ''">expand_more</span>
                </button>
                <div x-show="buyersOpen" x-cloak class="pl-4 space-y-1">
                    <a href="{{ route('stock.index') }}" wire:navigate class="block px-3 py-1.5 text-label-sm rounded-lg hover:bg-surface-container-low">В наличии</a>
                    <a href="{{ route('offers.index') }}" wire:navigate class="block px-3 py-1.5 text-label-sm rounded-lg hover:bg-surface-container-low">Спецпредложения</a>
                    <a href="{{ route('credit') }}" wire:navigate class="block px-3 py-1.5 text-label-sm rounded-lg hover:bg-surface-container-low">Кредит</a>
                    <a href="{{ route('insurance') }}" wire:navigate class="block px-3 py-1.5 text-label-sm rounded-lg hover:bg-surface-container-low">Страхование</a>
                    <a href="{{ route('leasing') }}" wire:navigate class="block px-3 py-1.5 text-label-sm rounded-lg hover:bg-surface-container-low">Лизинг</a>
                    <a href="{{ route('trade-in') }}" wire:navigate class="block px-3 py-1.5 text-label-sm rounded-lg hover:bg-surface-container-low">Trade-in</a>
                    <a href="{{ route('corporate') }}" wire:navigate class="block px-3 py-1.5 text-label-sm rounded-lg hover:bg-surface-container-low">Корпоративным</a>
                    <a href="{{ route('dealers.index') }}" wire:navigate class="block px-3 py-1.5 text-label-sm rounded-lg hover:bg-surface-container-low">Найти дилера</a>
                </div>
            </div>

            {{-- Владельцам --}}
            <div>
                <button @click="ownersOpen = !ownersOpen" class="flex items-center justify-between w-full font-label-sm text-secondary px-3 py-2 hover:text-primary hover:bg-surface-container-low rounded-lg">
                    Владельцам
                    <span class="material-symbols-outlined text-[18px]" :class="ownersOpen ? 'rotate-180' : ''">expand_more</span>
                </button>
                <div x-show="ownersOpen" x-cloak class="pl-4 space-y-1">
                    <a href="{{ route('owners') }}" wire:navigate class="block px-3 py-1.5 text-label-sm rounded-lg hover:bg-surface-container-low">Сервисные программы</a>
                    <a href="{{ route('service.index') }}" wire:navigate class="block px-3 py-1.5 text-label-sm rounded-lg hover:bg-surface-container-low">Запись на сервис</a>
                    <a href="{{ route('parts.index') }}" wire:navigate class="block px-3 py-1.5 text-label-sm rounded-lg hover:bg-surface-container-low">Запчасти по VIN</a>
                    <a href="{{ route('accessories.index') }}" wire:navigate class="block px-3 py-1.5 text-label-sm rounded-lg hover:bg-surface-container-low">Аксессуары</a>
                </div>
            </div>

            <a href="{{ route('about') }}" wire:navigate class="block px-3 py-2 text-label-sm text-secondary hover:text-primary rounded-lg">О бренде</a>
            <a href="{{ route('blog.index') }}" wire:navigate class="block px-3 py-2 text-label-sm text-secondary hover:text-primary rounded-lg">Новости</a>

            @auth
                <a href="{{ route('account') }}" wire:navigate class="block px-3 py-2 text-label-sm text-secondary hover:text-primary rounded-lg">Кабинет</a>
            @else
                <a href="{{ route('login') }}" wire:navigate class="block px-3 py-2 text-label-sm text-secondary hover:text-primary rounded-lg">Вход</a>
            @endauth

            <a href="{{ route('home') }}#contact" wire:navigate class="block w-full bg-primary text-on-primary px-5 py-3 rounded-full font-label-sm text-center hover:bg-primary/90 mt-4">
                Связаться
            </a>
        </div>
    </div>
</nav>
