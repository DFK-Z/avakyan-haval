<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class CarTrim extends Model
{
    /** @use HasFactory<\Database\Factories\CarTrimFactory> */
    use HasFactory;

    protected $fillable = [
        'car_model_id',
        'name',
        'slug',
        'price',
        'features',
        'is_active',
        'sort_order',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'features' => 'array',
            'price' => 'integer',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (CarTrim $trim): void {
            if (blank($trim->slug)) {
                $trim->slug = Str::slug($trim->name);
            }
        });
    }

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }

    public function formattedPrice(): string
    {
        return number_format($this->price, 0, ',', ' ').' ₽';
    }
}
