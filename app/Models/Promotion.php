<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Promotion extends Model
{
    /** @use HasFactory<\Database\Factories\PromotionFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'banner_path',
        'starts_at',
        'ends_at',
        'is_active',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Promotion $promotion): void {
            if (blank($promotion->slug)) {
                $promotion->slug = Str::slug($promotion->title);
            }
        });
    }

    public function carModels(): BelongsToMany
    {
        return $this->belongsToMany(CarModel::class);
    }

    public function isRunning(): bool
    {
        $now = now();

        return $this->is_active
            && ($this->starts_at === null || $this->starts_at->lte($now))
            && ($this->ends_at === null || $this->ends_at->gte($now));
    }
}
