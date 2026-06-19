<?php

namespace App\Http\Controllers;

use App\Models\DealerLocation;
use Illuminate\View\View;

class DealerController extends Controller
{
    public function index(): View
    {
        $dealers = DealerLocation::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->groupBy(fn (DealerLocation $d) => $d->line->value);

        return view('dealers.index', compact('dealers'));
    }
}
