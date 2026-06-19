<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockVehicle extends Model
{
    /** @use HasFactory<\Database\Factories\StockVehicleFactory> */
    use HasFactory;

    protected $fillable = [
        'car_model_id',
        'car_trim_id',
        'vin',
        'color',
        'price',
        'year',
        'engine',
        'drive',
        'is_available',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'integer',
            'year' => 'integer',
            'is_available' => 'boolean',
        ];
    }

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }

    public function carTrim(): BelongsTo
    {
        return $this->belongsTo(CarTrim::class);
    }

    public function formattedPrice(): string
    {
        return number_format($this->price, 0, ',', ' ').' ₽';
    }
}
