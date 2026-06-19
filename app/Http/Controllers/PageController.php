<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function credit(): View
    {
        return view('pages.credit');
    }

    public function insurance(): View
    {
        return view('pages.insurance');
    }

    public function leasing(): View
    {
        return view('pages.leasing');
    }

    public function corporate(): View
    {
        return view('pages.corporate');
    }

    public function tradeIn(): View
    {
        return view('pages.trade-in');
    }

    public function owners(): View
    {
        return view('pages.owners');
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function contacts(): View
    {
        return view('pages.contacts');
    }
}
