<x-layout.app title="Вход — Haval Volgograd">
    <section class="mx-auto grid max-w-container-max grid-cols-1 gap-10 px-margin-mobile py-section-gap md:px-margin-desktop lg:grid-cols-2 lg:items-center">
        <div class="relative hidden min-h-[560px] overflow-hidden rounded-3xl lg:block">
            <img src="{{ asset('images/cars/haval-city-banner.png') }}" alt="Автомобили HAVAL CITY" class="absolute inset-0 h-full w-full object-cover object-center">
            <div class="absolute inset-0 bg-linear-to-t from-black/75 via-transparent to-transparent"></div>
            <div class="absolute bottom-8 left-8 text-white">
                <p class="text-label-xs font-semibold uppercase tracking-[0.2em] text-white/70">Личный кабинет</p>
                <p class="mt-2 max-w-sm text-headline-md font-semibold">Ваш HAVAL всегда рядом</p>
            </div>
        </div>
        <div class="mx-auto w-full max-w-md">
        <h1 class="text-headline-lg font-semibold text-primary mb-6">Вход</h1>

        <form method="POST" action="{{ route('login.store') }}" class="space-y-4 bg-surface p-6 rounded-2xl border border-outline-variant">
            @csrf
            <div>
                <label class="text-label-sm text-secondary">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2">
                @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="text-label-sm text-secondary">Пароль</label>
                <input type="password" name="password" required class="w-full mt-1 rounded-lg border border-outline-variant px-3 py-2">
            </div>
            <label class="flex items-center gap-2 text-label-sm">
                <input type="checkbox" name="remember"> Запомнить меня
            </label>
            <button type="submit" class="w-full bg-primary text-on-primary py-3 rounded-full font-label-sm">Войти</button>
        </form>

        <p class="text-center text-label-sm text-secondary mt-6">
            Нет аккаунта?
            <a href="{{ route('register') }}" class="text-primary font-semibold hover:underline">Зарегистрироваться</a>
        </p>
        </div>
    </section>
</x-layout.app>
