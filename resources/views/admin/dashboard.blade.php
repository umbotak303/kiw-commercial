@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header_title', 'Ringkasan Dashboard')

@section('content')
<div class="space-y-8">

    <!-- Stat Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <!-- Card 1: Total Kartu (Cards) -->
        <a href="{{ route('admin.slides.index') }}" class="group bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs hover:border-blue-300 transition-all flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-slate-500">Total Kartu Aktif</p>
                <p class="text-2xl font-bold font-display text-slate-900 mt-1">{{ $totalSlides }} Kartu</p>
                <p class="text-[11px] text-blue-600 mt-1 font-semibold group-hover:underline flex items-center gap-1">
                    <span>Kelola Kartu</span>
                    <i data-lucide="arrow-right" class="w-3 h-3"></i>
                </p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                <i data-lucide="layers" class="w-6 h-6"></i>
            </div>
        </a>

        <!-- Card 2: Total Items (Tombol) -->
        <a href="{{ route('admin.slides.index') }}" class="group bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs hover:border-blue-300 transition-all flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-slate-500">Total Tombol Layanan</p>
                <p class="text-2xl font-bold font-display text-slate-900 mt-1">{{ $totalItems }} Tombol</p>
                <p class="text-[11px] text-blue-600 mt-1 font-semibold group-hover:underline flex items-center gap-1">
                    <span>Tautan & Kontak</span>
                    <i data-lucide="arrow-right" class="w-3 h-3"></i>
                </p>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                <i data-lucide="link" class="w-6 h-6"></i>
            </div>
        </a>

        <!-- Card 3: Current Theme & Color -->
        <a href="{{ route('admin.settings.index') }}" class="group bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs hover:border-blue-300 transition-all flex items-center justify-between">
            <div>
                <p class="text-xs font-medium text-slate-500">Tema & Skema Warna</p>
                <p class="text-sm font-bold font-display text-slate-900 mt-1">
                    @php
                        $preset = $settings['theme_style'] ?? 'corporate_navy';
                        $labels = [
                            'white_purple' => 'White & Purple',
                            'corporate_navy' => 'Corporate Navy',
                            'emerald_green' => 'Eco Emerald',
                            'royal_blue' => 'Royal Blue',
                            'dark_slate' => 'Dark Slate & Gold',
                            'modern_minimalist' => 'Modern Minimalist',
                        ];
                    @endphp
                    {{ $labels[$preset] ?? ucwords(str_replace('_', ' ', $preset)) }}
                </p>
                <div class="flex items-center gap-2 mt-1">
                    <span class="w-3.5 h-3.5 rounded-full border border-slate-200 shadow-2xs" style="background-color: {{ $settings['theme_primary'] ?? '#2563eb' }};"></span>
                    <span class="text-[11px] text-blue-600 font-mono font-bold">{{ $settings['theme_primary'] ?? '#2563eb' }}</span>
                </div>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-105 transition-transform">
                <i data-lucide="palette" class="w-6 h-6"></i>
            </div>
        </a>
    </div>

    <!-- Cards Overview & Quick Actions -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left: Cards List (2 cols) -->
        <div class="lg:col-span-2 bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs">
            <div class="flex items-center justify-between mb-5">
                <div>
                    <h2 class="text-base font-bold font-display text-slate-900">Daftar Kartu (Cards) Aktif</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Urutan kartu yang tampil bertumpuk pada landing page visitor.</p>
                </div>
                <a href="{{ route('admin.slides.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                    <span>Kelola Semua Kartu</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>

            <div class="space-y-3">
                @forelse($slides as $slide)
                    <div class="p-4 rounded-2xl border border-slate-100 hover:border-blue-200 bg-slate-50/50 hover:bg-blue-50/20 transition-all flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3.5">
                            <div class="w-9 h-9 rounded-xl bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-xs shrink-0">
                                {{ $slide->order }}
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-slate-900">{{ $slide->title }}</h3>
                                <p class="text-xs text-slate-500 mt-0.5">{{ $slide->subtitle }}</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-blue-100 text-blue-800">
                                {{ $slide->items_count }} Tombol
                            </span>
                            <a href="{{ route('admin.slides.edit', $slide) }}" class="p-1.5 rounded-lg text-slate-400 hover:text-blue-700 hover:bg-white transition-colors" title="Edit Kartu">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8 px-4 text-slate-500 text-xs space-y-3">
                        <p class="text-slate-400">Belum ada kartu dibuat di database.</p>
                        <form action="{{ route('admin.seed.defaults') }}" method="POST" onsubmit="return confirm('Muat data kartu dan tombol bawaan KIW Commercial?')">
                            @csrf
                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold text-xs shadow-md shadow-blue-600/20 transition-all cursor-pointer">
                                <i data-lucide="download" class="w-4 h-4"></i>
                                <span>Klik di Sini untuk Memuat Kartu Bawaan KIW</span>
                            </button>
                        </form>
                    </div>
                @endforelse
            </div>

            <div class="mt-4 pt-3 border-t border-slate-100 text-right">
                <a href="{{ route('admin.slides.create') }}" class="inline-flex items-center gap-2 text-xs font-bold text-blue-600 hover:text-blue-800">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i>
                    <span>Tambah Kartu Baru</span>
                </a>
            </div>
        </div>

        <!-- Right: Theme & Color Quick Info -->
        <div class="space-y-6">
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
                <div class="flex items-center gap-3 pb-3 border-b border-slate-100">
                    <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                        <i data-lucide="palette" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 font-display">Status Tema & Warna</h3>
                        <p class="text-[11px] text-slate-500">Konfigurasi visual aktif</p>
                    </div>
                </div>

                <div class="space-y-2.5 text-xs">
                    <div class="flex items-center justify-between py-1.5 border-b border-slate-50">
                        <span class="text-slate-500">Preset Tema:</span>
                        <span class="font-bold text-slate-800">{{ $labels[$preset] ?? $preset }}</span>
                    </div>
                    <div class="flex items-center justify-between py-1.5 border-b border-slate-50">
                        <span class="text-slate-500">Warna Aksen:</span>
                        <div class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-md border border-slate-200" style="background-color: {{ $settings['theme_primary'] ?? '#2563eb' }};"></span>
                            <span class="font-mono font-semibold text-slate-800">{{ $settings['theme_primary'] ?? '#2563eb' }}</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between py-1.5 border-b border-slate-50">
                        <span class="text-slate-500">Background Halaman:</span>
                        <div class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-md border border-slate-200" style="background-color: {{ $settings['theme_bg'] ?? '#0b1528' }};"></span>
                            <span class="font-mono font-semibold text-slate-800">{{ $settings['theme_bg'] ?? '#0b1528' }}</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between py-1.5">
                        <span class="text-slate-500">Warna Kartu:</span>
                        <div class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-md border border-slate-200" style="background-color: {{ $settings['theme_card_bg'] ?? '#ffffff' }};"></span>
                            <span class="font-mono font-semibold text-slate-800">{{ $settings['theme_card_bg'] ?? '#ffffff' }}</span>
                        </div>
                    </div>
                </div>

                <a href="{{ route('admin.settings.index') }}" class="w-full py-2.5 px-3 rounded-xl bg-blue-50 hover:bg-blue-100/80 text-blue-700 text-xs font-bold transition-colors flex items-center justify-center gap-2">
                    <i data-lucide="sliders" class="w-3.5 h-3.5"></i>
                    <span>Sesuaikan Tema & Warna</span>
                </a>
            </div>
        </div>

    </div>

</div>
@endsection
