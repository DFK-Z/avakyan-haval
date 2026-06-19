<?php

use App\Models\BlogPost;
use App\Models\CarModel;
use App\Models\Promotion;
use App\Models\Review;
use App\Models\Service;
use App\Models\TeamMember;
use Livewire\Component;

new class extends Component
{
    public function with(): array
    {
        return [
            'popularCars' => CarModel::query()
                ->with('galleryItems')
                ->where('is_active', true)
                ->where('is_popular', true)
                ->orderBy('sort_order')
                ->limit(3)
                ->get(),
            'reviews' => Review::query()
                ->where('is_published', true)
                ->orderBy('sort_order')
                ->limit(3)
                ->get(),
            'promotions' => Promotion::query()
                ->where('is_active', true)
                ->where(function ($query): void {
                    $query->whereNull('ends_at')->orWhere('ends_at', '>=', now());
                })
                ->orderByDesc('starts_at')
                ->limit(2)
                ->get(),
            'services' => Service::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->limit(4)
                ->get(),
            'blogPosts' => BlogPost::query()
                ->where('is_published', true)
                ->orderByDesc('published_at')
                ->limit(3)
                ->get(),
            'teamMembers' => TeamMember::query()
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->limit(4)
                ->get(),
        ];
    }
};
?>

<div>
    @include('livewire.home-view')
</div>
