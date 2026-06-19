<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Accessory extends Model
{
    /** @use HasFactory<\Database\Factories\AccessoryFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'category',
        'image',
        'is_active',
        'sort_order',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Accessory $accessory): void {
            if (blank($accessory->slug)) {
                $accessory->slug = Str::slug($accessory->name);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
