<x-layout.app title="Владельцам — HAVAL Volgograd">
    <x-ui.page-hero
        title="Владельцам"
        subtitle="Сервисные программы и поддержка на дороге."
        eyebrow="HAVAL PRO"
        :image="asset('images/cars/haval-pro-banner.png')"
    />
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @foreach (\App\Models\ServiceProgram::query()->where('is_active', true)->where('audience', 'owners')->orderBy('sort_order')->get() as $program)
                <div class="bg-surface rounded-2xl p-6 border border-outline-variant">
                    @if ($program->icon)
                        <span class="material-symbols-outlined text-3xl text-primary mb-4">{{ $program->icon }}</span>
                    @endif
                    <h3 class="font-semibold text-primary mb-2">{{ $program->name }}</h3>
                    <p class="text-label-sm text-secondary">{{ $program->description }}</p>
                </div>
            @endforeach
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <livewire:service-booking />
            <div>
                <h2 class="text-headline-md font-semibold text-primary mb-4">Калькулятор ТО</h2>
                <p class="text-secondary text-label-sm mb-4">Рассчитайте ориентировочную стоимость технического обслуживания.</p>
                <a href="{{ route('services.index') }}" wire:navigate class="text-primary font-label-sm hover:underline">Все услуги сервиса →</a>
            </div>
        </div>
    </section>
</x-layout.app>
