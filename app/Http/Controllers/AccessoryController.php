<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use Illuminate\View\View;

class AccessoryController extends Controller
{
    public function index(): View
    {
        $accessories = Accessory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        return view('accessories.index', compact('accessories'));
    }
}
