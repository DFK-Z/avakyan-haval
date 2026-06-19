<?php

namespace App\Models;

use App\Enums\CarLine;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealerLocation extends Model
{
    /** @use HasFactory<\Database\Factories\DealerLocationFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'line',
        'address',
        'city',
        'phone',
        'email',
        'working_hours',
        'latitude',
        'longitude',
        'is_active',
        'sort_order',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'line' => CarLine::class,
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }
}
