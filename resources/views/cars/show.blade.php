<x-layout.app
    :title="$car->meta_title ?? $car->brand.' '.$car->name"
    :meta_description="$car->meta_description"
>
    <section class="relative min-h-[520px] overflow-hidden bg-primary text-on-primary sm:min-h-[580px]">
        @if ($car->hero_image ?? $car->thumb_image)
            <img
                src="{{ $car->hero_image ?? $car->thumb_image }}"
                alt="{{ $car->brand }} {{ $car->name }}"
                class="absolute inset-0 h-full w-full object-cover object-center"
            >
        @endif
        <div class="absolute inset-0 bg-linear-to-r from-black/90 via-black/65 to-black/10"></div>

        <div class="relative mx-auto flex min-h-[520px] max-w-container-max items-end px-margin-mobile py-12 md:px-margin-desktop sm:min-h-[580px] sm:items-center">
            <div class="max-w-[520px] text-white">
                <nav class="mb-5 flex flex-wrap items-center gap-2 text-xs text-white/55">
                    <a href="{{ route('home') }}" wire:navigate class="hover:text-white transition-colors">Главная</a>
                    <span>/</span>
                    <a href="{{ route('catalog') }}" wire:navigate class="hover:text-white transition-colors">Автопарк</a>
                    <span>/</span>
                    <span class="text-white/70">{{ $car->brand }} {{ $car->name }}</span>
                </nav>

                @if ($car->badge)
                    <span class="mb-4 inline-block rounded-full border border-white/30 px-3 py-1 text-xs uppercase tracking-widest text-white/75 backdrop-blur-sm">
                        {{ $car->badge }}
                    </span>
                @endif

                <h1 class="mb-3 text-[clamp(2rem,4.5vw,3.2rem)] font-bold leading-tight tracking-[-0.02em] text-white">
                    {{ $car->brand }} {{ $car->name }}
                </h1>

                @if ($car->tagline)
                    <p class="mb-5 max-w-xs text-base leading-relaxed text-white/80">
                        {{ $car->tagline }}
                    </p>
                @endif

                <p class="mb-7 text-[1.7rem] font-bold text-white">
                    от {{ $car->formattedPrice() }}
                </p>

                <div class="flex flex-wrap gap-3">
                    <a href="#forms" class="rounded-full bg-white px-7 py-3 text-sm font-semibold text-black transition-colors hover:bg-white/90">
                        Тест-драйв
                    </a>
                    <a href="#calculator" class="rounded-full border border-white/40 bg-black/10 px-7 py-3 text-sm text-white backdrop-blur-sm transition-colors hover:bg-white/10">
                        Кредит
                    </a>
                    <a href="{{ route('stock.index', ['model' => $car->slug]) }}" wire:navigate
                       class="rounded-full border border-white/40 bg-black/10 px-7 py-3 text-sm text-white backdrop-blur-sm transition-colors hover:bg-white/10">
                        В наличии
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Характеристики под баннером --}}
    <section class="bg-surface-container-lowest border-b border-outline-variant">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-4 flex flex-wrap gap-4">
            <span class="inline-flex items-center gap-2 text-label-sm text-secondary">
                <span class="material-symbols-outlined text-[18px]">directions_car</span>
                {{ $car->category->label() }}
            </span>
            <span class="inline-flex items-center gap-2 text-label-sm text-secondary">
                <span class="material-symbols-outlined text-[18px]">settings</span>
                {{ $car->drive_type->label() }}
            </span>
            @if ($car->seats)
                <span class="inline-flex items-center gap-2 text-label-sm text-secondary">
                    <span class="material-symbols-outlined text-[18px]">person</span>
                    {{ $car->seats }} мест
                </span>
            @endif
            @if ($car->transmission)
                <span class="inline-flex items-center gap-2 text-label-sm text-secondary">
                    <span class="material-symbols-outlined text-[18px]">autorenew</span>
                    {{ $car->transmission }}
                </span>
            @endif
            @if ($car->model_year)
                <span class="inline-flex items-center gap-2 text-label-sm text-secondary">
                    <span class="material-symbols-outlined text-[18px]">calendar_today</span>
                    {{ $car->model_year }} г.
                </span>
            @endif
        </div>
    </section>

    {{-- Галерея + основная информация --}}
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter items-start">
            <div class="order-2 lg:order-1">
                @php $images = $car->galleryItems->where('type', \App\Enums\GalleryMediaType::Image) @endphp
                @if ($images->isNotEmpty())
                    <div class="space-y-4 sticky top-24">
                        <img src="{{ $images->first()->url() }}" alt="{{ $car->name }}" class="w-full aspect-[4/3] object-cover rounded-2xl border border-outline-variant" id="gallery-main">
                        @if ($images->count() > 1)
                            <div class="flex gap-2 overflow-x-auto pb-1">
                                @foreach ($images as $item)
                                    <button type="button" onclick="document.getElementById('gallery-main').src='{{ $item->url() }}'" class="shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 border-transparent hover:border-primary focus:border-primary transition-colors">
                                        <img src="{{ $item->url() }}" alt="" class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @elseif ($car->hero_image)
                    <div class="sticky top-24 overflow-hidden rounded-2xl border border-outline-variant bg-surface-container-low">
                        <img src="{{ $car->hero_image }}" alt="{{ $car->name }}" class="aspect-[16/9] w-full object-cover">
                    </div>
                @else
                    <div class="w-full aspect-[4/3] bg-surface-container-low rounded-2xl flex items-center justify-center border border-outline-variant">
                        <span class="material-symbols-outlined text-6xl text-secondary">directions_car</span>
                    </div>
                @endif
            </div>

            <div class="order-1 lg:order-2 flex flex-col justify-center">
                <h2 class="text-headline-lg font-semibold text-primary mb-2">{{ $car->brand }} {{ $car->name }}</h2>

                @if ($car->tagline)
                    <p class="text-body-lg text-secondary mb-4">{{ $car->tagline }}</p>
                @endif

                <p class="text-display-lg-mobile md:text-headline-lg font-bold text-primary mb-6">от {{ $car->formattedPrice() }}</p>

                @if ($car->price_disclaimer)
                    <p class="text-label-xs text-secondary mb-6 leading-relaxed">{{ $car->price_disclaimer }}</p>
                @endif

                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="#forms" class="bg-primary text-on-primary px-8 py-3.5 rounded-full font-label-sm text-center hover:bg-primary/90 transition-colors">
                        Записаться на тест-драйв
                    </a>
                    <a href="#calculator" class="bg-surface text-primary border border-outline-variant px-8 py-3.5 rounded-full font-label-sm text-center hover:bg-surface-container-low transition-colors">
                        Рассчитать кредит
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Характеристики и комплектации --}}
    <section class="bg-surface-container-low py-12">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter">
                @if ($car->specs)
                    <div class="bg-surface rounded-2xl p-8 border border-outline-variant">
                        <h2 class="text-headline-md font-semibold text-primary mb-6">Технические характеристики</h2>
                        <ul class="space-y-0">
                            @foreach ($car->specs as $key => $value)
                                <li class="flex justify-between text-label-sm border-b border-outline-variant py-3 last:border-0">
                                    <span class="text-secondary">{{ $key }}</span>
                                    <span class="text-primary font-medium">{{ $value }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($car->trims->isNotEmpty())
                    <div class="bg-surface rounded-2xl p-8 border border-outline-variant">
                        <h2 class="text-headline-md font-semibold text-primary mb-6">Комплектации и цены</h2>
                        <ul class="space-y-4">
                            @foreach ($car->trims as $trim)
                                <li class="flex justify-between items-center p-4 bg-surface-container-low rounded-xl">
                                    <div>
                                        <span class="font-semibold text-primary block">{{ $trim->name }}</span>
                                        @if ($trim->features)
                                            <span class="text-label-sm text-secondary">{{ collect($trim->features)->take(2)->implode(' · ') }}</span>
                                        @endif
                                    </div>
                                    <span class="font-bold text-primary whitespace-nowrap ml-4">{{ $trim->formattedPrice() }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Конфигуратор --}}
    <section class="bg-surface-container-low py-section-gap">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-gutter items-start">
                <livewire:model-configurator :car="$car" />
                <div id="calculator" class="scroll-mt-24">
                    <h2 class="text-headline-md font-semibold text-primary mb-4">Кредитный калькулятор</h2>
                    <livewire:loan-calculator :car="$car" />
                </div>
            </div>
        </div>
    </section>

    {{-- Формы заявок — внизу страницы --}}
    <section id="forms" class="bg-surface-container-low border-t border-outline-variant py-section-gap scroll-mt-24">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <h2 class="text-headline-lg font-semibold text-primary mb-3">Оставить заявку</h2>
                <p class="text-secondary">
                    Выберите удобный способ связи: тест-драйв, оценка trade-in или обратный звонок. Все поля обязательны, если не указано иное.
                </p>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <div class="xl:col-span-1">
                    <livewire:test-drive-form :car="$car" />
                </div>
                <div class="xl:col-span-1">
                    <livewire:trade-in-form :car="$car" />
                </div>
                <div class="xl:col-span-1">
                    <livewire:callback-form :car="$car" />
                </div>
            </div>
        </div>
    </section>
</x-layout.app>
