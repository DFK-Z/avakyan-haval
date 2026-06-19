<?php

namespace App\Models;

use App\Enums\CarCategory;
use App\Enums\CarLine;
use App\Enums\DriveType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class CarModel extends Model
{
    /** @use HasFactory<\Database\Factories\CarModelFactory> */
    use HasFactory;

    protected $fillable = [
        'brand',
        'line',
        'name',
        'tagline',
        'badge',
        'slug',
        'category',
        'drive_type',
        'price_from',
        'specs',
        'seats',
        'doors',
        'transmission',
        'model_year',
        'price_disclaimer',
        'hero_image',
        'thumb_image',
        'meta_title',
        'meta_description',
        'is_active',
        'is_popular',
        'is_updated',
        'show_in_hero',
        'sort_order',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'line' => CarLine::class,
            'category' => CarCategory::class,
            'drive_type' => DriveType::class,
            'model_year' => 'integer',
            'specs' => 'array',
            'price_from' => 'integer',
            'is_active' => 'boolean',
            'is_popular' => 'boolean',
            'is_updated' => 'boolean',
            'show_in_hero' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (CarModel $carModel): void {
            if (blank($carModel->slug)) {
                $carModel->slug = Str::slug($carModel->name);
            }
        });
    }

    public function galleryItems(): HasMany
    {
        return $this->hasMany(CarGalleryItem::class)->orderBy('sort_order');
    }

    public function trims(): HasMany
    {
        return $this->hasMany(CarTrim::class)->orderBy('sort_order');
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    public function promotions(): BelongsToMany
    {
        return $this->belongsToMany(Promotion::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function stockVehicles(): HasMany
    {
        return $this->hasMany(StockVehicle::class);
    }

    public function availableStock(): HasMany
    {
        return $this->stockVehicles()->where('is_available', true);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function formattedPrice(): string
    {
        return number_format($this->price_from, 0, ',', ' ').' ₽';
    }
}
