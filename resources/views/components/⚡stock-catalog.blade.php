<?php

use App\Models\CarModel;
use App\Models\StockVehicle;
use Livewire\Attributes\Url;
use Livewire\Component;

new class extends Component
{
    #[Url]
    public string $model = '';

    #[Url]
    public string $line = '';

    public function with(): array
    {
        return [
            'vehicles' => StockVehicle::query()
                ->with(['carModel', 'carTrim'])
                ->where('is_available', true)
                ->when($this->model, fn ($q) => $q->whereHas('carModel', fn ($m) => $m->where('slug', $this->model)))
                ->when($this->line, fn ($q) => $q->whereHas('carModel', fn ($m) => $m->where('line', $this->line)))
                ->latest()
                ->get(),
            'models' => CarModel::query()->where('is_active', true)->orderBy('sort_order')->get(),
        ];
    }
};
?>

<div>
    @include('livewire.stock-catalog-view')
</div>
