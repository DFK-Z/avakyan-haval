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

    public string $email = '';

    public string $preferredAt = '';

    public string $message = '';

    public bool $submitted = false;

    public function mount(?CarModel $car = null): void
    {
        $this->car = $car;
    }

    public function submit(): void
    {
        if (! $this->passesHoneypot()) {
            return;
        }

        $key = 'test-drive:'.request()->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $this->addError('phone', 'Слишком много попыток. Попробуйте позже.');

            return;
        }

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email'],
            'preferredAt' => ['required', 'date', 'after:now'],
        ]);

        app(LeadService::class)->create([
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email ?: null,
            'type' => LeadType::TestDrive,
            'car_model_id' => $this->car?->id,
            'message' => $this->message ?: null,
            'preferred_at' => $this->preferredAt,
        ]);

        RateLimiter::hit($key, 3600);
        $this->submitted = true;
        $this->reset(['name', 'phone', 'email', 'preferredAt', 'message', 'website']);
    }
};
?>

<div id="test-drive" class="bg-surface rounded-2xl border border-outline-variant p-6 h-full flex flex-col">
    <h3 class="text-headline-md font-semibold text-primary mb-1">Тест-драйв</h3>
    <p class="text-label-sm text-secondary mb-4">Познакомьтесь с {{ $car?->name ?? 'моделью' }} на дороге</p>

    @if ($submitted)
        <p class="text-secondary">Заявка отправлена! Мы свяжемся с вами в ближайшее время.</p>
    @else
        <form wire:submit="submit" class="space-y-4">
            <input type="text" wire:model="website" class="hidden" tabindex="-1" autocomplete="off">
            <input type="text" wire:model="honeypot" class="hidden" tabindex="-1" autocomplete="off">

            <input type="text" wire:model="name" placeholder="Имя" class="w-full rounded-lg border border-outline-variant px-3 py-2">
            @error('name') <p class="text-sm text-red-600">{{ $message }}</p> @enderror

            <input type="tel" wire:model="phone" placeholder="Телефон" class="w-full rounded-lg border border-outline-variant px-3 py-2">
            @error('phone') <p class="text-sm text-red-600">{{ $message }}</p> @enderror

            <input type="email" wire:model="email" placeholder="Email (необязательно)" class="w-full rounded-lg border border-outline-variant px-3 py-2">

            <input type="datetime-local" wire:model="preferredAt" class="w-full rounded-lg border border-outline-variant px-3 py-2">
            @error('preferredAt') <p class="text-sm text-red-600">{{ $message }}</p> @enderror

            <textarea wire:model="message" placeholder="Комментарий" rows="3" class="w-full rounded-lg border border-outline-variant px-3 py-2"></textarea>

            <button type="submit" class="w-full bg-primary text-on-primary py-3 rounded-full font-label-sm hover:bg-primary/90">
                <span wire:loading.remove>Отправить заявку</span>
                <span wire:loading>Отправка...</span>
            </button>
        </form>
    @endif
</div>
