<?php

namespace App\Http\Controllers;

use App\Models\LogisticsService;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('index', [
            'publicServices' => $this->activeServices()->take(6),
        ]);
    }

    public function about(): View
    {
        return view('about');
    }

    public function service(): View
    {
        return view('service', [
            'publicServices' => $this->activeServices(),
        ]);
    }

    public function feature(): View
    {
        return view('feature');
    }

    public function contact(): View
    {
        return view('contact');
    }

    private function activeServices()
    {
        return LogisticsService::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }
}
