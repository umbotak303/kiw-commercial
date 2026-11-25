<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\Slide;
use App\Models\SlideItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalSlides = Slide::count();
        $totalItems = SlideItem::count();
        $slides = Slide::withCount('items')->orderBy('order')->get();
        $settings = SiteSetting::all()->pluck('value', 'key');

        return view('admin.dashboard', compact(
            'totalSlides',
            'totalItems',
            'slides',
            'settings'
        ));
    }

    public function seedDefaults(): RedirectResponse
    {
        try {
            // Jalankan migrasi terlebih dahulu jika tabel belum ada di database production
            Artisan::call('migrate', ['--force' => true]);

            // Jalankan seeder bawaan KIW
            Artisan::call('db:seed', [
                '--class' => 'Database\\Seeders\\KiwCommercialSeeder',
                '--force' => true,
            ]);

            return redirect()->route('admin.dashboard')->with('success', 'Tabel dan data bawaan kartu KIW berhasil dimuat ke database!');
        } catch (\Throwable $e) {
            return redirect()->route('admin.dashboard')->with('error', 'Gagal memuat data bawaan: ' . $e->getMessage());
        }
    }
}
