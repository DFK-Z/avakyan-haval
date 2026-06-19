<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    /** @use HasFactory<\Database\Factories\PartFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'description',
        'price',
        'vin_pattern',
        'stock',
        'is_active',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'stock' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public function matchesVin(string $vin): bool
    {
        if (blank($this->vin_pattern)) {
            return true;
        }

        return str_contains(strtoupper($vin), strtoupper($this->vin_pattern));
    }
}
