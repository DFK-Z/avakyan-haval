<?php

namespace App\Models;

use App\Enums\GalleryMediaType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class CarGalleryItem extends Model
{
    /** @use HasFactory<\Database\Factories\CarGalleryItemFactory> */
    use HasFactory;

    protected $fillable = [
        'car_model_id',
        'type',
        'path',
        'alt',
        'sort_order',
        'is_360',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => GalleryMediaType::class,
            'sort_order' => 'integer',
            'is_360' => 'boolean',
        ];
    }

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

    public function url(): string
    {
        if (str_starts_with($this->path, 'http')) {
            return $this->path;
        }

        return Storage::disk('public')->url($this->path);
    }
}
