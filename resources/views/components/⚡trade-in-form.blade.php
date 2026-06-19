<?php

use App\Enums\LeadType;
use App\Livewire\Concerns\ChecksHoneypot;
use App\Models\CarModel;
use App\Services\LeadService;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

new class extends Component
{
    use ChecksHoneypot;

    public ?CarModel $car = null;

    public string $name = '';

    public string $phone = '';

    public string $currentCar = '';

    public int $mileage = 0;

    public int $estimatedValue = 0;

    public bool $submitted = false;

    public function mount(?CarModel $car = null): void
    {
        $this->car = $car;
    }

    public function updatedMileage(): void
    {
        $this->estimatedValue = max(0, 800_000 - (int) ($this->mileage / 1000) * 15_000);
    }

    public function submit(): void
    {
        if (! $this->passesHoneypot()) {
            return;
        }

        $key = 'trade-in:'.request()->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $this->addError('phone', 'Слишком много попыток. Попробуйте позже.');

            return;
        }

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'currentCar' => ['required', 'string', 'max:255'],
            'mileage' => ['required', 'integer', 'min:0'],
        ]);

        app(LeadService::class)->create([
            'name' => $this->name,
            'phone' => $this->phone,
            'type' => LeadType::TradeIn,
            'car_model_id' => $this->car?->id,
            'message' => "Авто: {$this->currentCar}, пробег: {$this->mileage} км",
            'metadata' => [
                'estimated_value' => $this->estimatedValue,
                'mileage' => $this->mileage,
            ],
        ]);

        RateLimiter::hit($key, 3600);
        $this->submitted = true;
    }
};
?>

<div class="bg-surface rounded-2xl border border-outline-variant p-6 h-full flex flex-col">
    <h3 class="text-headline-md font-semibold text-primary mb-1">Trade-in</h3>
    <p class="text-label-sm text-secondary mb-4">Оценка вашего авто в зачёт покупки</p>

    @if ($submitted)
        <p class="text-secondary">Спасибо! Менеджер подготовит точную оценку.</p>
    @else
        <form wire:submit="submit" class="space-y-4">
            <input type="text" wire:model="website" class="hidden" tabindex="-1" autocomplete="off">
            <input type="text" wire:model="honeypot" class="hidden" tabindex="-1" autocomplete="off">

            <input type="text" wire:model="name" placeholder="Имя" class="w-full rounded-lg border border-outline-variant px-3 py-2">
            <input type="tel" wire:model="phone" placeholder="Телефон" class="w-full rounded-lg border border-outline-variant px-3 py-2">
            <input type="text" wire:model="currentCar" placeholder="Ваш автомобиль" class="w-full rounded-lg border border-outline-variant px-3 py-2">
            <input type="number" wire:model.live="mileage" placeholder="Пробег, км" class="w-full rounded-lg border border-outline-variant px-3 py-2">

            @if ($estimatedValue > 0)
                <p class="text-label-sm text-secondary">Предварительная оценка: <strong class="text-primary">{{ number_format($estimatedValue, 0, ',', ' ') }} ₽</strong></p>
            @endif

            <button type="submit" class="w-full bg-primary text-on-primary py-3 rounded-full font-label-sm">Получить оценку</button>
        </form>
    @endif
</div>
