<x-layout.app :title="$post->title.' — Блог Haval'">
    <x-ui.page-hero
        :title="$post->title"
        :subtitle="$post->excerpt"
        eyebrow="Блог HAVAL"
        :image="$post->image ?: asset('images/cars/f7-hero-lg.png')"
    />
    <article class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop py-section-gap">
        <nav class="text-label-sm text-secondary mb-6">
            <a href="{{ route('blog.index') }}" wire:navigate class="hover:text-primary">Блог</a>
            <span> / </span>
            <span class="text-primary">{{ $post->title }}</span>
        </nav>

        <p class="text-label-sm text-secondary mb-8">{{ $post->published_at?->format('d F Y') }}</p>

        <div class="prose prose-neutral max-w-3xl text-secondary whitespace-pre-line">
            {{ $post->content }}
        </div>
    </article>
</x-layout.app>
