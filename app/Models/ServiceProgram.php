<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ServiceProgram extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceProgramFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'audience',
        'icon',
        'cta_label',
        'cta_url',
        'is_active',
        'sort_order',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (ServiceProgram $program): void {
            if (blank($program->slug)) {
                $program->slug = Str::slug($program->name);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
