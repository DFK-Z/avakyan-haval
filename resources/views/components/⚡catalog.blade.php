<?php

use App\Enums\CarCategory;
use App\Enums\DriveType;
use App\Models\CarModel;
use Livewire\Attributes\Url;
use Livewire\Component;

new class extends Component
{
    #[Url]
    public ?int $priceMax = null;

    #[Url]
    public string $category = '';

    #[Url]
    public string $drive = '';

    public function updatedPriceMax(): void
    {
        //
    }

    public function with(): array
    {
        return [
            'cars' => CarModel::query()
                ->with('galleryItems')
                ->where('is_active', true)
                ->when($this->priceMax, fn ($q) => $q->where('price_from', '<=', $this->priceMax))
                ->when($this->category, fn ($q) => $q->where('category', $this->category))
                ->when($this->drive, fn ($q) => $q->where('drive_type', $this->drive))
                ->orderBy('sort_order')
                ->get(),
            'categories' => CarCategory::cases(),
            'drives' => DriveType::cases(),
        ];
    }
};
?>

<div>
    @include('livewire.catalog-view')
</div>
