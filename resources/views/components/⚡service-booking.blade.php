<?php

use App\Enums\LeadType;
use App\Livewire\Concerns\ChecksHoneypot;
use App\Models\CarModel;
use App\Services\LeadService;
use App\Services\MaintenanceCalculator;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

new class extends Component
{
    use ChecksHoneypot;

    public string $name = '';

    public string $phone = '';

    public ?int $carModelId = null;

    public int $mileage = 30_000;

    public string $preferredAt = '';

    public bool $submitted = false;

    public function maintenancePrice(): int
    {
        if (! $this->carModelId) {
            return 0;
        }

        $car = CarModel::query()->find($this->carModelId);

        if (! $car) {
            return 0;
        }

        return app(MaintenanceCalculator::class)->calculate($car, $this->mileage);
    }

    public function submit(): void
    {
        if (! $this->passesHoneypot()) {
            return;
        }

        $key = 'service:'.request()->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $this->addError('phone', 'Слишком много попыток.');

            return;
        }

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'preferredAt' => ['required', 'date', 'after:now'],
            'mileage' => ['required', 'integer', 'min:0'],
        ]);

        app(LeadService::class)->create([
            'name' => $this->name,
            'phone' => $this->phone,
            'type' => LeadType::Callback,
            'car_model_id' => $this->carModelId,
            'message' => 'Запись на сервис. Пробег: '.$this->mileage.' км',
            'preferred_at' => $this->preferredAt,
            'metadata' => ['estimated_to' => $this->maintenancePrice()],
        ]);

        RateLimiter::hit($key, 3600);
        $this->submitted = true;
    }

    public function with(): array
    {
        return [
            'cars' => CarModel::query()->where('is_active', true)->orderBy('name')->get(),
        ];
    }
};
?>

<div class="bg-surface rounded-2xl border border-outline-variant p-6">
    <h3 class="text-headline-md font-semibold text-primary mb-4">Запись на сервис</h3>

    @if ($submitted)
        <p class="text-secondary">Заявка принята! Сервисный консультант свяжется с вами.</p>
    @else
        <form wire:submit="submit" class="space-y-4">
            <input type="text" wire:model="website" class="hidden" tabindex="-1" autocomplete="off">
            <input type="text" wire:model="honeypot" class="hidden" tabindex="-1" autocomplete="off">

            <input type="text" wire:model="name" placeholder="Имя *" class="w-full rounded-lg border border-outline-variant px-3 py-2">
            <input type="tel" wire:model="phone" placeholder="Телефон *" class="w-full rounded-lg border border-outline-variant px-3 py-2">

            <select wire:model.live="carModelId" class="w-full rounded-lg border-outline-variant">
                <option value="">Модель автомобиля</option>
                @foreach ($cars as $car)
                    <option value="{{ $car->id }}">HAVAL {{ $car->name }}</option>
                @endforeach
            </select>

            <div>
                <label class="text-label-sm text-secondary">Пробег: {{ number_format($mileage, 0, ',', ' ') }} км</label>
                <input type="range" min="0" max="200000" step="5000" wire:model.live="mileage" class="w-full accent-primary">
            </div>

            @if ($carModelId && $this->maintenancePrice() > 0)
                <p class="text-label-sm text-secondary">Ориентировочная стоимость ТО: <strong class="text-primary">{{ number_format($this->maintenancePrice(), 0, ',', ' ') }} ₽</strong></p>
            @endif

            <input type="datetime-local" wire:model="preferredAt" class="w-full rounded-lg border border-outline-variant px-3 py-2">

            <button type="submit" class="w-full bg-primary text-on-primary py-3 rounded-full font-label-sm">Записаться</button>
        </form>
    @endif
</div>
