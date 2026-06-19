<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\View\View;

class OfferController extends Controller
{
    public function index(): View
    {
        $promotions = Promotion::query()
            ->where('is_active', true)
            ->orderByDesc('starts_at')
            ->get();

        return view('offers.index', compact('promotions'));
    }
}
