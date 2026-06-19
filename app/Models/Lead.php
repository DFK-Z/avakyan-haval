<?php

namespace App\Models;

use App\Enums\LeadStatus;
use App\Enums\LeadType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    /** @use HasFactory<\Database\Factories\LeadFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'type',
        'status',
        'car_model_id',
        'car_trim_id',
        'message',
        'preferred_at',
        'metadata',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => LeadType::class,
            'status' => LeadStatus::class,
            'preferred_at' => 'datetime',
            'metadata' => 'array',
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
}
