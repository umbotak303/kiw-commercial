<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\Slide;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function index(): View
    {
        try {
            $dbSettings = SiteSetting::all()->pluck('value', 'key')->toArray();
        } catch (\Throwable $e) {
            $dbSettings = [];
        }

        $defaultSettings = config('kiw.brand') ?? [];
        $settings = array_merge($defaultSettings, $dbSettings);

        try {
            $dbSlides = Slide::where('is_active', true)
                ->with(['activeItems' => fn($q) => $q->orderBy('order', 'asc')])
                ->orderBy('order', 'asc')
                ->get();

            if ($dbSlides->isNotEmpty()) {
                $slides = $dbSlides->map(function ($slide) {
                    $slideArr = $slide->toArray();
                    $slideArr['items'] = $slideArr['active_items'] ?? $slideArr['items'] ?? [];
                    return $slideArr;
                })->toArray();
            } else {
                $slides = config('kiw.slides') ?? [];
            }
        } catch (\Throwable $e) {
            $slides = config('kiw.slides') ?? [];
        }

        return view('welcome', compact('settings', 'slides'));
    }
}
