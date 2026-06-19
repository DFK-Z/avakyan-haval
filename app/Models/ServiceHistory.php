<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceHistory extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceHistoryFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_model_id',
        'service_name',
        'mileage',
        'performed_at',
        'notes',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'mileage' => 'integer',
            'performed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function carModel(): BelongsTo
    {
        return $this->belongsTo(CarModel::class);
    }
}
