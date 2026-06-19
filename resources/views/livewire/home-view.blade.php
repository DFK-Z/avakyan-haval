{{-- Hero slider --}}
<livewire:hero-slider />

{{-- Quick actions --}}
<section class="border-b border-outline-variant bg-surface-container-lowest">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-4 flex flex-wrap justify-center gap-3 md:gap-6">
        <a href="{{ route('stock.index') }}" wire:navigate class="flex items-center gap-2 text-label-sm text-primary hover:underline"><span class="material-symbols-outlined text-[20px]">inventory_2</span> В наличии</a>
        <a href="{{ route('stock.index') }}" wire:navigate class="flex items-center gap-2 text-label-sm text-primary hover:underline"><span class="material-symbols-outlined text-[20px]">directions_car</span> Тест-драйв</a>
        <a href="{{ route('dealers.index') }}" wire:navigate class="flex items-center gap-2 text-label-sm text-primary hover:underline"><span class="material-symbols-outlined text-[20px]">location_on</span> Найти дилера</a>
        <a href="{{ route('credit') }}" wire:navigate class="flex items-center gap-2 text-label-sm text-primary hover:underline"><span class="material-symbols-outlined text-[20px]">calculate</span> Кредит</a>
        <a href="{{ route('trade-in') }}" wire:navigate class="flex items-center gap-2 text-label-sm text-primary hover:underline"><span class="material-symbols-outlined text-[20px]">swap_horiz</span> Trade-in</a>
        <a href="{{ route('catalog') }}" wire:navigate class="flex items-center gap-2 text-label-sm text-primary hover:underline"><span class="material-symbols-outlined text-[20px]">tune</span> Модели</a>
    </div>
</section>

{{-- Stats strip --}}
<section class="border-y border-outline-variant py-stack-lg bg-surface-container-lowest">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop grid grid-cols-2 sm:grid-cols-4 gap-6 text-center">
        <div>
            <div class="text-headline-md font-bold text-primary mb-1">11</div>
            <div class="text-label-sm text-secondary">Моделей HAVAL</div>
        </div>
        <div>
            <div class="text-headline-md font-bold text-primary mb-1">24/7</div>
            <div class="text-label-sm text-secondary">Поддержка на дороге</div>
        </div>
        <div>
            <div class="text-headline-md font-bold text-primary mb-1">100%</div>
            <div class="text-label-sm text-secondary">Официальный дилер</div>
        </div>
        <div>
            <div class="text-headline-md font-bold text-primary mb-1">10+</div>
            <div class="text-label-sm text-secondary">Лет на рынке</div>
        </div>
    </div>
</section>

{{-- Drive luxury --}}
<section class="mx-auto grid max-w-container-max grid-cols-1 items-center gap-10 px-margin-mobile py-section-gap md:px-margin-desktop lg:grid-cols-2">
    <div>
        <h2 class="mb-stack-md text-headline-lg font-semibold leading-tight text-primary">
            Управляй роскошью,<br>живи свободой
        </h2>
        <p class="text-body-lg text-secondary">
            Ощутите комфорт, технологии и уверенность за рулём Haval. Короткая поездка по городу или дальнее путешествие — мы подберём идеальную модель и комплектацию.
        </p>
        <div class="mt-8 grid grid-cols-2 gap-6 border-t border-outline-variant pt-8">
            <div>
                <div class="mb-1 text-headline-md font-bold text-primary">Кредит</div>
                <div class="text-label-sm text-secondary">от 12.5% годовых</div>
            </div>
            <div>
                <div class="mb-1 text-headline-md font-bold text-primary">Trade-in</div>
                <div class="text-label-sm text-secondary">Быстрая оценка</div>
            </div>
            <div>
                <div class="mb-1 text-headline-md font-bold text-primary">ТО</div>
                <div class="text-label-sm text-secondary">Официальный сервис</div>
            </div>
            <div>
                <div class="mb-1 text-headline-md font-bold text-primary">Гарантия</div>
                <div class="text-label-sm text-secondary">5 лет поддержки</div>
            </div>
        </div>
    </div>
    <div class="relative min-h-[360px] overflow-hidden rounded-3xl">
        <img src="{{ asset('images/cars/haval-city-banner.png') }}" alt="Линейка автомобилей HAVAL CITY" class="absolute inset-0 h-full w-full object-cover object-center">
        <div class="absolute inset-0 bg-linear-to-t from-black/70 via-transparent to-transparent"></div>
        <div class="absolute bottom-0 left-0 p-8 text-white">
            <p class="text-label-xs font-semibold uppercase tracking-[0.2em] text-white/65">HAVAL CITY</p>
            <p class="mt-2 text-headline-md font-semibold">Город начинается с выбора</p>
        </div>
    </div>
</section>

{{-- Promotions --}}
@if ($promotions->isNotEmpty())
    <section class="bg-surface-container-low py-section-gap">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
            <h2 class="text-headline-lg font-semibold text-primary mb-stack-lg">Акции и спецпредложения</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($promotions as $promotion)
                    <article class="overflow-hidden rounded-2xl border border-outline-variant bg-surface" wire:key="promo-{{ $promotion->id }}">
                        <img src="{{ $promotion->banner_path ?: asset('images/cars/dargo-hero-lg.png') }}" alt="" class="h-48 w-full object-cover object-center">
                        <div class="flex flex-col justify-between gap-4 p-8 sm:flex-row sm:items-center">
                            <div>
                                <h3 class="mb-2 text-headline-md font-semibold text-primary">{{ $promotion->title }}</h3>
                                <p class="text-label-sm text-secondary">{{ $promotion->description }}</p>
                            </div>
                            @if ($promotion->ends_at)
                                <div class="shrink-0 text-center" x-data="{
                                    ends: new Date('{{ $promotion->ends_at->toIso8601String() }}').getTime(),
                                    days: 0, hours: 0, minutes: 0,
                                    tick() {
                                        const diff = Math.max(0, this.ends - Date.now());
                                        this.days = Math.floor(diff / 86400000);
                                        this.hours = Math.floor((diff % 86400000) / 3600000);
                                        this.minutes = Math.floor((diff % 3600000) / 60000);
                                    }
                                }" x-init="tick(); setInterval(() => tick(), 60000)">
                                    <p class="mb-1 text-label-xs text-secondary">До конца акции</p>
                                    <p class="font-bold text-primary" x-text="`${days}д ${hours}ч ${minutes}м`"></p>
                                </div>
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif

{{-- Model lineup CITY / PRO --}}
<livewire:model-lineup />

{{-- Buyer / Owner cards (как на haval.ru) --}}
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap">
    <h2 class="text-headline-lg font-semibold text-primary mb-8 text-center">Покупателям и владельцам</h2>
    @php
        $ownerCards = [
            ['route' => route('credit'), 'image' => asset('images/cars/f7-hero-lg.png'), 'icon' => 'account_balance', 'title' => 'HAVAL Кредит', 'body' => 'Кредит со сниженной ставкой', 'cta' => 'Рассчитать'],
            ['route' => route('corporate'), 'image' => asset('images/cars/poer-hero-lg.png'), 'icon' => 'business', 'title' => 'Для бизнеса', 'body' => 'Корпоративные продажи', 'cta' => 'Запросить условия'],
            ['route' => route('offers.index'), 'image' => asset('images/cars/dargo-hero-lg.png'), 'icon' => 'local_offer', 'title' => 'Спецпредложения', 'body' => 'Акции и выгоды', 'cta' => 'Получить выгоду'],
            ['route' => route('accessories.index'), 'image' => asset('images/cars/jolion-hero-lg.png'), 'icon' => 'shopping_bag', 'title' => 'Аксессуары', 'body' => 'Оригинальная коллекция', 'cta' => 'В каталог'],
            ['route' => route('service.index'), 'image' => asset('images/cars/h3-hero-lg.png'), 'icon' => 'build', 'title' => 'Сервис', 'body' => 'Запишитесь на обслуживание', 'cta' => 'Записаться'],
            ['route' => route('owners'), 'image' => asset('images/cars/haval-pro-banner.png'), 'icon' => 'support_agent', 'title' => 'Помощь на дороге', 'body' => 'Расширенная поддержка', 'cta' => 'Подробнее'],
        ];
    @endphp
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($ownerCards as $ownerCard)
            <a href="{{ $ownerCard['route'] }}" wire:navigate wire:key="owner-card-{{ $loop->index }}" class="group overflow-hidden rounded-2xl border border-outline-variant bg-surface transition-shadow hover:shadow-lg">
                <img src="{{ $ownerCard['image'] }}" alt="" class="h-36 w-full object-cover transition duration-500 group-hover:scale-105">
                <div class="p-6">
                    <span class="material-symbols-outlined mb-3 text-3xl text-primary">{{ $ownerCard['icon'] }}</span>
                    <h3 class="mb-2 font-semibold text-primary">{{ $ownerCard['title'] }}</h3>
                    <p class="text-label-sm text-secondary">{{ $ownerCard['body'] }}</p>
                    <span class="mt-4 inline-block text-label-sm text-primary group-hover:underline">{{ $ownerCard['cta'] }} →</span>
                </div>
            </a>
        @endforeach
    </div>
</section>

{{-- Popular cars --}}
<section class="bg-surface-container-low py-section-gap">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="flex flex-col md:flex-row justify-between items-end mb-stack-lg gap-4">
            <div>
                <h2 class="text-headline-lg font-semibold text-primary mb-2">Найдите свой идеальный автомобиль</h2>
                <p class="text-secondary">Популярные модели Haval в наличии.</p>
            </div>
            <a href="{{ route('catalog') }}" wire:navigate class="bg-primary text-on-primary px-6 py-3 rounded-full font-label-sm hover:bg-primary/90 whitespace-nowrap">
                Весь автопарк
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($popularCars as $car)
                <x-ui.car-card :car="$car" />
            @endforeach
        </div>
    </div>
</section>

{{-- Booking steps --}}
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap">
    <div class="flex flex-col lg:flex-row justify-between items-start gap-12">
        <div class="lg:w-1/3">
            <h2 class="text-headline-lg font-semibold text-primary mb-4 leading-tight">Просто. Быстро.<br>Без забот.</h2>
            <p class="text-secondary mb-8">От выбора модели до выдачи ключей — прозрачный процесс покупки и сопровождение на каждом шаге.</p>
            <a href="{{ route('catalog') }}" wire:navigate class="bg-primary text-on-primary px-8 py-3 rounded-full font-label-sm hover:bg-primary/90 inline-block">
                Начать подбор
            </a>
        </div>
        <div class="lg:w-2/3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach ([
                ['Выбрать авто', 'Изучите каталог моделей и комплектаций.'],
                ['Рассчитать кредит', 'Онлайн-калькулятор на странице модели.'],
                ['Тест-драйв', 'Запишитесь на удобное время.'],
                ['Trade-in', 'Оцените свой автомобиль.'],
                ['Оформление', 'Поможем с кредитом и документами.'],
                ['Выдача', 'Получите ключи и начните путь.'],
            ] as $step)
                <div class="bg-surface-container-low p-6 rounded-xl">
                    <h4 class="font-label-sm font-semibold text-primary mb-2">{{ $step[0] }}</h4>
                    <p class="text-xs text-secondary">{{ $step[1] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Services preview --}}
<section class="bg-surface-container-low py-section-gap">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="flex justify-between items-end mb-stack-lg">
            <h2 class="text-headline-lg font-semibold text-primary">Услуги дилерского центра</h2>
            <a href="{{ route('services.index') }}" wire:navigate class="font-label-sm text-primary hover:underline">Все услуги</a>
        </div>
        @php
            $serviceImages = [
                asset('images/cars/f7-hero-lg.png'),
                asset('images/cars/h3-hero-lg.png'),
                asset('images/cars/dargo-x-hero-lg.png'),
                asset('images/cars/h7-hero-lg.png'),
            ];
        @endphp
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($services as $service)
                <a href="{{ route('services.show', $service) }}" wire:navigate wire:key="service-{{ $service->id }}" class="group overflow-hidden rounded-xl border border-outline-variant bg-surface transition-shadow hover:shadow-md">
                    <img src="{{ $serviceImages[$loop->index % count($serviceImages)] }}" alt="" class="h-32 w-full object-cover transition duration-500 group-hover:scale-105">
                    <div class="p-6">
                        <h4 class="mb-2 font-semibold text-primary">{{ $service->name }}</h4>
                        <p class="line-clamp-2 text-label-sm text-secondary">{{ $service->description }}</p>
                        @if ($service->formattedPrice())
                            <p class="mt-3 text-label-sm font-semibold text-primary">от {{ $service->formattedPrice() }}</p>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- VIN search --}}
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap">
    <div class="max-w-2xl mx-auto">
        <h2 class="text-headline-lg font-semibold text-primary mb-2 text-center">Поиск запчастей по VIN</h2>
        <p class="text-secondary text-center mb-8">Введите VIN вашего автомобиля — покажем совместимые позиции со склада.</p>
        <livewire:vin-search />
    </div>
</section>

{{-- Team --}}
@if ($teamMembers->isNotEmpty())
    <section class="bg-surface-container-lowest py-section-gap border-y border-outline-variant">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
            <h2 class="text-headline-lg font-semibold text-primary mb-8 text-center">Наша команда</h2>
            <div class="grid grid-cols-1 items-center gap-8 lg:grid-cols-[1.05fr_1.3fr]">
                <div class="relative min-h-[300px] overflow-hidden rounded-2xl">
                    <img src="{{ asset('images/cars/haval-pro-banner.png') }}" alt="Линейка HAVAL PRO" class="absolute inset-0 h-full w-full object-cover object-center">
                    <div class="absolute inset-0 bg-linear-to-t from-black/70 via-transparent to-transparent"></div>
                    <p class="absolute bottom-6 left-6 text-body-lg font-semibold text-white">Эксперты HAVAL CITY и PRO</p>
                </div>
                <div class="grid grid-cols-2 gap-6">
                    @foreach ($teamMembers as $member)
                        <div class="text-center" wire:key="team-{{ $member->id }}">
                            <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-surface-container-low text-secondary">
                                <span class="material-symbols-outlined text-4xl">person</span>
                            </div>
                            <h4 class="font-semibold text-primary">{{ $member->name }}</h4>
                            <p class="text-label-sm text-secondary">{{ $member->position }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif

{{-- Reviews --}}
<section class="bg-surface-container-lowest py-section-gap border-y border-outline-variant">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <h2 class="text-headline-lg font-semibold text-primary mb-8">Доверяют тысячи</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($reviews as $review)
                <div class="bg-surface rounded-2xl p-8 border border-outline-variant" wire:key="review-{{ $review->id }}">
                    <div class="flex gap-1 mb-4">
                        @for ($i = 0; $i < $review->rating; $i++)
                            <span class="material-symbols-outlined text-primary text-[18px]">star</span>
                        @endfor
                    </div>
                    <span class="material-symbols-outlined text-4xl text-outline-variant/40 mb-4 block">format_quote</span>
                    <p class="text-secondary mb-6">{{ $review->content }}</p>
                    <div class="font-label-sm font-semibold text-primary">{{ $review->author_name }}</div>
                    <div class="text-xs text-secondary">{{ $review->author_location }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Blog --}}
@if ($blogPosts->isNotEmpty())
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap">
        <div class="flex justify-between items-end mb-stack-lg">
            <h2 class="text-headline-lg font-semibold text-primary">Блог</h2>
            <a href="{{ route('blog.index') }}" wire:navigate class="font-label-sm text-primary hover:underline">Все статьи</a>
        </div>
        @php
            $blogImages = [
                asset('images/cars/jolion-hero-lg.png'),
                asset('images/cars/dargo-hero-lg.png'),
                asset('images/cars/f7-hero-lg.png'),
            ];
        @endphp
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($blogPosts as $post)
                <a href="{{ route('blog.show', $post) }}" wire:navigate wire:key="post-{{ $post->id }}" class="group block overflow-hidden rounded-2xl border border-outline-variant bg-surface transition-shadow hover:shadow-md">
                    <img src="{{ $post->image ?: $blogImages[$loop->index % count($blogImages)] }}" alt="" class="h-44 w-full object-cover transition duration-500 group-hover:scale-105">
                    <div class="p-6">
                        <p class="mb-2 text-label-sm text-secondary">{{ $post->published_at?->format('d.m.Y') }}</p>
                        <h3 class="mb-2 font-semibold text-primary">{{ $post->title }}</h3>
                        <p class="line-clamp-3 text-label-sm text-secondary">{{ $post->excerpt }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endif

{{-- FAQ --}}
<section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap grid grid-cols-1 lg:grid-cols-2 gap-12">
    <div>
        <h2 class="text-headline-lg font-semibold text-primary mb-4">Есть вопросы?<br>У нас есть ответы!</h2>
        <p class="text-secondary">Частые вопросы о покупке, кредите, тест-драйве и сервисе Haval в Волгограде.</p>
    </div>
    <div class="flex flex-col gap-4" x-data="{ open: 0 }">
        @foreach ([
            ['Как забронировать тест-драйв?', 'Выберите модель в каталоге, откройте карточку авто и заполните форму внизу страницы. Менеджер подтвердит дату и время.'],
            ['Можно ли купить в кредит?', 'Да. На странице каждой модели есть кредитный калькулятор. Оставьте заявку — подберём программу банков-партнёров.'],
            ['Принимаете ли trade-in?', 'Да, оцениваем ваш автомобиль по рыночным параметрам. Форма trade-in доступна на странице модели и в каталоге.'],
            ['Где находится дилерский центр?', 'г. Волгоград. Точный адрес и часы работы — в разделе контактов в подвале сайта.'],
            ['Какая гарантия на автомобили?', 'Официальная гарантия производителя на новые автомобили Haval. Подробности уточняйте у менеджера.'],
        ] as $index => $faq)
            <div class="rounded-xl overflow-hidden border border-outline-variant">
                <button
                    type="button"
                    @click="open = open === {{ $index }} ? -1 : {{ $index }}"
                    @class([
                        'w-full flex justify-between items-center p-6 text-left font-label-sm font-semibold transition-colors',
                    ])
                    :class="open === {{ $index }} ? 'bg-primary text-on-primary' : 'bg-surface-container-low text-primary hover:bg-surface-container'"
                >
                    {{ $faq[0] }}
                    <span class="material-symbols-outlined" x-text="open === {{ $index }} ? 'expand_less' : 'expand_more'"></span>
                </button>
                <div x-show="open === {{ $index }}" x-cloak class="bg-primary text-on-primary px-6 pb-6 text-sm text-on-primary/80">
                    {{ $faq[1] }}
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- CTA callback --}}
<section id="contact" class="bg-surface-container-low py-section-gap scroll-mt-24">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
        <div class="grid grid-cols-1 items-center gap-10 lg:grid-cols-2">
            <img src="{{ asset('images/cars/haval-city-banner.png') }}" alt="Автомобили HAVAL у дилерского центра" class="h-full min-h-[360px] w-full rounded-2xl object-cover object-center">
            <div>
                <div class="mb-8 max-w-xl">
                    <h2 class="mb-2 text-headline-lg font-semibold text-primary">Остались вопросы?</h2>
                    <p class="text-secondary">Оставьте номер — перезвоним в течение 15 минут в рабочее время.</p>
                </div>
                <div class="max-w-md">
                    <livewire:callback-form />
                </div>
            </div>
        </div>
    </div>
</section>
