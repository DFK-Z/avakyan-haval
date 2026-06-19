@props([
    'title',
    'subtitle' => null,
    'image' => '/images/cars/haval-city-banner.png',
    'eyebrow' => null,
])

<section class="relative isolate min-h-[280px] overflow-hidden bg-primary text-on-primary sm:min-h-[340px]">
    <img src="{{ $image }}" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover object-center" aria-hidden="true">
    <div class="absolute inset-0 -z-10 bg-linear-to-r from-black/90 via-black/60 to-black/10"></div>

    <div class="mx-auto flex min-h-[280px] max-w-container-max flex-col justify-end px-margin-mobile py-10 md:px-margin-desktop sm:min-h-[340px] sm:py-14">
        @if ($eyebrow)
            <p class="mb-4 text-label-xs font-semibold uppercase tracking-[0.2em] text-white/65">{{ $eyebrow }}</p>
        @endif
        <h1 class="max-w-3xl text-headline-lg font-bold text-white sm:text-[42px]">{{ $title }}</h1>
        @if ($subtitle)
            <p class="mt-3 max-w-2xl text-body-lg text-white/80">{{ $subtitle }}</p>
        @endif
    </div>
</section>
