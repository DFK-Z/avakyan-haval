<x-layout.app title="Блог — Haval Volgograd">
    <x-ui.page-hero
        title="Блог"
        subtitle="Новости, обзоры и советы от официального дилера HAVAL."
        eyebrow="Журнал дилера"
        :image="asset('images/cars/f7-hero-lg.png')"
    />
    <section class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap">
        @php
            $postImages = [
                asset('images/cars/f7-hero-lg.png'),
                asset('images/cars/dargo-hero-lg.png'),
                asset('images/cars/jolion-hero-lg.png'),
            ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($posts as $post)
                <a href="{{ route('blog.show', $post) }}" wire:navigate class="group block overflow-hidden rounded-2xl border border-outline-variant bg-surface transition-shadow hover:shadow-md">
                    <img src="{{ $post->image ?: $postImages[$loop->index % count($postImages)] }}" alt="" class="h-48 w-full object-cover transition duration-500 group-hover:scale-105">
                    <div class="p-6">
                        <p class="text-label-sm text-secondary mb-2">{{ $post->published_at?->format('d.m.Y') }}</p>
                        <h2 class="text-headline-md font-semibold text-primary mb-3">{{ $post->title }}</h2>
                        <p class="text-secondary text-label-sm line-clamp-4">{{ $post->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}</p>
                    </div>
                </a>
            @empty
                <p class="col-span-full text-secondary">Статьи скоро появятся.</p>
            @endforelse
        </div>

        <div class="mt-12">{{ $posts->links() }}</div>
    </section>
</x-layout.app>
