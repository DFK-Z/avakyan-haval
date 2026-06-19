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

        $key = 'callback:'.request()->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $this->addError('phone', 'Слишком много попыток. Попробуйте позже.');

            return;
        }

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'message' => ['nullable', 'string', 'max:1000'],
        ]);

        app(LeadService::class)->create([
            'name' => $this->name,
            'phone' => $this->phone,
            'type' => LeadType::Callback,
            'car_model_id' => $this->car?->id,
            'message' => $this->message ?: null,
        ]);

        RateLimiter::hit($key, 3600);
        $this->submitted = true;
        $this->reset(['name', 'phone', 'message', 'website', 'honeypot']);
    }
};
?>

<div class="bg-surface rounded-2xl border border-outline-variant p-6 h-full flex flex-col">
    <h3 class="text-headline-md font-semibold text-primary mb-1">Обратный звонок</h3>
    <p class="text-label-sm text-secondary mb-4">Перезвоним и ответим на вопросы</p>

    @if ($submitted)
        <p class="text-secondary flex-1 flex items-center">Спасибо! Мы свяжемся с вами в ближайшее время.</p>
    @else
        <form wire:submit="submit" class="space-y-4 flex-1 flex flex-col">
            <input type="text" wire:model="website" class="hidden" tabindex="-1" autocomplete="off">
            <input type="text" wire:model="honeypot" class="hidden" tabindex="-1" autocomplete="off">

            <input type="text" wire:model="name" placeholder="Имя *" class="w-full rounded-lg border border-outline-variant px-3 py-2.5">
            @error('name') <p class="text-sm text-red-600">{{ $message }}</p> @enderror

            <input type="tel" wire:model="phone" placeholder="Телефон *" class="w-full rounded-lg border border-outline-variant px-3 py-2.5">
            @error('phone') <p class="text-sm text-red-600">{{ $message }}</p> @enderror

            <textarea wire:model="message" placeholder="Ваш вопрос" rows="3" class="w-full rounded-lg border border-outline-variant px-3 py-2.5 flex-1 min-h-[80px]"></textarea>

            <button type="submit" class="w-full bg-primary text-on-primary py-3 rounded-full font-label-sm hover:bg-primary/90 mt-auto">
                <span wire:loading.remove>Жду звонка</span>
                <span wire:loading>Отправка...</span>
            </button>
        </form>
    @endif
</div>
