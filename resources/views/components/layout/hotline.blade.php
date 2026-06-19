<div class="bg-primary text-on-primary text-label-sm py-2 fixed top-0 left-0 w-full z-[60]">
    <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop flex justify-between items-center">
        <a href="{{ config('dealer.hotline_href') }}" class="flex items-center gap-2 hover:opacity-90">
            <span class="material-symbols-outlined text-[16px]">call</span>
            Горячая линия: {{ config('dealer.hotline') }}
        </a>
        <div class="hidden md:flex items-center gap-4 text-on-primary/80">
            <a href="{{ route('stock.index') }}" wire:navigate class="hover:text-on-primary">В наличии</a>
            <a href="{{ route('dealers.index') }}" wire:navigate class="hover:text-on-primary">Найти дилера</a>
            <a href="{{ route('catalog') }}#test-drive" wire:navigate class="hover:text-on-primary">Тест-драйв</a>
        </div>
    </div>
</div>
