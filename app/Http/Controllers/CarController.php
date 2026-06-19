<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\View\View;

class CarController extends Controller
{
    public function show(CarModel $car): View
    {
        abort_unless($car->is_active, 404);

        $car->load(['galleryItems', 'trims', 'promotions']);

        return view('cars.show', compact('car'));
    }
}
