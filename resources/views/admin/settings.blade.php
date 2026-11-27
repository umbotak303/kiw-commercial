@extends('layouts.admin')

@section('title', 'Atur Tema, Kartu & Warna')
@section('header_title', 'Atur Tema, Kartu & Warna')

@section('content')
<div class="w-full space-y-8"
     x-data="{
         activeTab: 'presets',
         themeStyle: '{{ $settings['theme_style'] ?? 'corporate_navy' }}',
         primaryColor: '{{ $settings['theme_primary'] ?? '#0ea5e9' }}',
         bgColor: '{{ $settings['theme_bg'] ?? '#070d18' }}',
         cardBg: '{{ $settings['theme_card_bg'] ?? '#0f172a' }}',
         cardText: '{{ $settings['theme_card_text'] ?? '#f1f5f9' }}',
         cardBorder: '{{ $settings['theme_card_border'] ?? '#0ea5e9' }}',
         cardRadius: '{{ $settings['theme_card_radius'] ?? 'rounded-[28px]' }}',
         buttonBg: '{{ $settings['theme_button_bg'] ?? 'rgba(0, 0, 0, 0.25)' }}',
         buttonText: '{{ $settings['theme_button_text'] ?? '#f8fafc' }}',
         buttonBorder: '{{ $settings['theme_button_border'] ?? '#0ea5e9' }}',

         presets: {
             maroon_gold: {
                 name: 'Heritage Maroon & Gold (Full Card Style)',
                 primary: '#a67c2e',
                 bg: '#181f2a',
                 card_bg: '#3a0e05',
                 card_text: '#ffffff',
                 card_border: '#a67c2e',
                 btn_bg: 'rgba(0, 0, 0, 0.22)',
                 btn_text: '#ffffff',
                 btn_border: '#a67c2e',
                 radius: 'rounded-[28px]'
             },
             corporate_navy: {
                 name: 'Corporate Navy',
                 primary: '#0ea5e9',
                 bg: '#070d18',
                 card_bg: '#0f172a',
                 card_text: '#f1f5f9',
                 card_border: '#0ea5e9',
                 btn_bg: 'rgba(0, 0, 0, 0.25)',
                 btn_text: '#f8fafc',
                 btn_border: '#0ea5e9',
                 radius: 'rounded-[28px]'
             },
             white_purple: {
                 name: 'White & Purple',
                 primary: '#7c3aed',
                 bg: '#f1f5f9',
                 card_bg: '#ffffff',
                 card_text: '#1e293b',
                 card_border: '#7c3aed',
                 btn_bg: '#f8fafc',
                 btn_text: '#1e293b',
                 btn_border: '#7c3aed',
                 radius: 'rounded-[28px]'
             },
             emerald_green: {
                 name: 'Eco Emerald',
                 primary: '#10b981',
                 bg: '#041f17',
                 card_bg: '#064e3b',
                 card_text: '#ffffff',
                 card_border: '#10b981',
                 btn_bg: 'rgba(0, 0, 0, 0.22)',
                 btn_text: '#ffffff',
                 btn_border: '#10b981',
                 radius: 'rounded-[28px]'
             }
         },

         applyPreset(key) {
             this.themeStyle = key;
             if (this.presets[key]) {
                 const p = this.presets[key];
                 this.primaryColor = p.primary;
                 this.bgColor = p.bg;
                 this.cardBg = p.card_bg;
                 this.cardText = p.card_text;
                 this.cardBorder = p.card_border;
                 this.buttonBg = p.btn_bg;
                 this.buttonText = p.btn_text;
                 this.buttonBorder = p.btn_border;
                 this.cardRadius = p.radius;
             }
         }
     }">

    <!-- Page Title & Header Info -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl font-bold font-display text-slate-900">Pengaturan Tema, Kartu & Skema Warna</h1>
            <p class="text-xs text-slate-500 mt-1">Sesuaikan desain kartu landing page, pilih tema preset, dan atur palet warna secara real-time.</p>
        </div>
        <a href="{{ route('home') }}" target="_blank" class="px-4 py-2 rounded-xl bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-bold transition-all inline-flex items-center gap-1.5 self-start sm:self-auto">
            <i data-lucide="external-link" class="w-4 h-4"></i>
            <span>Buka Pratinjau Live</span>
        </a>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf
        <!-- Hidden inputs for selected preset style and radius -->
        <input type="hidden" name="theme_style" :value="themeStyle">
        <input type="hidden" name="theme_card_radius" :value="cardRadius">

        <!-- SECTION 1: LIVE INTERACTIVE PREVIEW & THEME PRESETS -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 items-stretch">
            
            <!-- Left: Theme Presets & Color Customization (50% Symmetrical) -->
            <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs flex flex-col justify-between">
                <div>
                    <!-- Header with Tabs Switcher -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center shrink-0">
                                <i data-lucide="palette" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h2 class="text-base font-bold text-slate-900 font-display">1. Pilihan Preset Tema</h2>
                                <p class="text-xs text-slate-500">Pilih kombinasi instan atau sesuaikan palet warna secara detail.</p>
                            </div>
                        </div>

                        <!-- Tab Button Toggle: Presets vs Kustomisasi Warna -->
                        <div class="inline-flex p-1 bg-slate-100 rounded-xl text-xs font-semibold self-start sm:self-auto shrink-0 border border-slate-200/60">
                            <button type="button"
                                    @click="activeTab = 'presets'"
                                    :class="activeTab === 'presets' ? 'bg-white text-blue-700 shadow-xs' : 'text-slate-600 hover:text-slate-900'"
                                    class="px-3 py-1.5 rounded-lg transition-all flex items-center gap-1.5">
                                <i data-lucide="layout-grid" class="w-3.5 h-3.5"></i>
                                <span>Pilihan Preset Tema</span>
                            </button>
                            <button type="button"
                                    @click="activeTab = 'custom'"
                                    :class="activeTab === 'custom' ? 'bg-white text-blue-700 shadow-xs' : 'text-slate-600 hover:text-slate-900'"
                                    class="px-3 py-1.5 rounded-lg transition-all flex items-center gap-1.5">
                                <i data-lucide="droplet" class="w-3.5 h-3.5"></i>
                                <span>Kustomisasi Skema Warna</span>
                            </button>
                        </div>
                    </div>

                    <!-- TAB 1: Theme Presets Cards Grid (2x2 Balanced) -->
                    <div x-show="activeTab === 'presets'" class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 pt-5 transition-all">
                        
                        <!-- Preset 1: Heritage Maroon & Gold (Full Card Style) -->
                        <div @click="applyPreset('maroon_gold')"
                             :class="themeStyle === 'maroon_gold' ? 'border-amber-600 ring-2 ring-amber-500/20 bg-amber-50/20' : 'border-slate-200 hover:border-amber-300'"
                             class="p-4 rounded-2xl border-2 cursor-pointer transition-all flex flex-col justify-between relative group">
                            <input type="radio" value="maroon_gold" class="sr-only" x-model="themeStyle">
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <span class="text-xs font-bold text-slate-900">Heritage Maroon & Gold</span>
                                    <span class="w-3.5 h-3.5 rounded-full border flex items-center justify-center" :class="themeStyle === 'maroon_gold' ? 'border-amber-600 bg-amber-600' : 'border-slate-300'">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white" x-show="themeStyle === 'maroon_gold'"></span>
                                    </span>
                                </div>
                                <p class="text-[11px] text-slate-500 leading-relaxed min-h-[34px]">Tampilan kartu klasik dengan nuansa marun & garis emas elegan.</p>
                            </div>
                            <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center gap-1.5">
                                <span class="w-5 h-5 rounded-md bg-[#3a0e05] shadow-2xs border border-white/20" title="Deep Maroon"></span>
                                <span class="w-5 h-5 rounded-md bg-[#a67c2e] shadow-2xs" title="Gold Ribbon"></span>
                                <span class="w-5 h-5 rounded-md bg-[#181f2a] shadow-2xs" title="Slate Frame"></span>
                            </div>
                        </div>

                        <!-- Preset 2: Corporate Navy -->
                        <div @click="applyPreset('corporate_navy')"
                             :class="themeStyle === 'corporate_navy' ? 'border-blue-600 ring-2 ring-blue-500/20 bg-blue-50/20' : 'border-slate-200 hover:border-blue-300'"
                             class="p-4 rounded-2xl border-2 cursor-pointer transition-all flex flex-col justify-between relative group">
                            <input type="radio" value="corporate_navy" class="sr-only" x-model="themeStyle">
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <span class="text-xs font-bold text-slate-900">Corporate Navy</span>
                                    <span class="w-3.5 h-3.5 rounded-full border flex items-center justify-center" :class="themeStyle === 'corporate_navy' ? 'border-blue-600 bg-blue-600' : 'border-slate-300'">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white" x-show="themeStyle === 'corporate_navy'"></span>
                                    </span>
                                </div>
                                <p class="text-[11px] text-slate-500 leading-relaxed min-h-[34px]">Dark mode futuristik modern dengan nuansa biru malam industri.</p>
                            </div>
                            <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center gap-1.5">
                                <span class="w-5 h-5 rounded-md bg-slate-950 border border-slate-800 shadow-2xs" title="Dark Slate"></span>
                                <span class="w-5 h-5 rounded-md bg-sky-500 shadow-2xs" title="Cyan Accent"></span>
                                <span class="w-5 h-5 rounded-md bg-indigo-600 shadow-2xs" title="Royal Navy"></span>
                            </div>
                        </div>
                        
                        <!-- Preset 3: White & Purple -->
                        <div @click="applyPreset('white_purple')"
                             :class="themeStyle === 'white_purple' ? 'border-blue-600 ring-2 ring-blue-500/20 bg-blue-50/20' : 'border-slate-200 hover:border-blue-300'"
                             class="p-4 rounded-2xl border-2 cursor-pointer transition-all flex flex-col justify-between relative group">
                            <input type="radio" value="white_purple" class="sr-only" x-model="themeStyle">
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <span class="text-xs font-bold text-slate-900">White & Purple</span>
                                    <span class="w-3.5 h-3.5 rounded-full border flex items-center justify-center" :class="themeStyle === 'white_purple' ? 'border-blue-600 bg-blue-600' : 'border-slate-300'">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white" x-show="themeStyle === 'white_purple'"></span>
                                    </span>
                                </div>
                                <p class="text-[11px] text-slate-500 leading-relaxed min-h-[34px]">Tema kartu terang, bersih, modern, dan bernuansa profesional.</p>
                            </div>
                            <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center gap-1.5">
                                <span class="w-5 h-5 rounded-md bg-white border border-slate-200 shadow-2xs" title="Putih"></span>
                                <span class="w-5 h-5 rounded-md bg-purple-700 shadow-2xs" title="Ungu Korporat"></span>
                                <span class="w-5 h-5 rounded-md bg-violet-500 shadow-2xs" title="Aksen Violet"></span>
                            </div>
                        </div>

                        <!-- Preset 4: Eco Emerald -->
                        <div @click="applyPreset('emerald_green')"
                             :class="themeStyle === 'emerald_green' ? 'border-emerald-600 ring-2 ring-emerald-500/20 bg-emerald-50/20' : 'border-slate-200 hover:border-emerald-300'"
                             class="p-4 rounded-2xl border-2 cursor-pointer transition-all flex flex-col justify-between relative group">
                            <input type="radio" value="emerald_green" class="sr-only" x-model="themeStyle">
                            <div>
                                <div class="flex items-center justify-between mb-1.5">
                                    <span class="text-xs font-bold text-slate-900">Eco Emerald</span>
                                    <span class="w-3.5 h-3.5 rounded-full border flex items-center justify-center" :class="themeStyle === 'emerald_green' ? 'border-emerald-600 bg-emerald-600' : 'border-slate-300'">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white" x-show="themeStyle === 'emerald_green'"></span>
                                    </span>
                                </div>
                                <p class="text-[11px] text-slate-500 leading-relaxed min-h-[34px]">Nuansa hijau asri ramah lingkungan kawasan industri KIW.</p>
                            </div>
                            <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center gap-1.5">
                                <span class="w-5 h-5 rounded-md bg-[#064e3b] shadow-2xs border border-white/20" title="Dark Emerald"></span>
                                <span class="w-5 h-5 rounded-md bg-[#10b981] shadow-2xs" title="Emerald Ribbon"></span>
                                <span class="w-5 h-5 rounded-md bg-[#041f17] shadow-2xs" title="Deep Forest Canvas"></span>
                            </div>
                        </div>

                    </div>

                    <!-- TAB 2: Kustomisasi Skema Warna (Merged 8 Color Pickers Grid) -->
                    <div x-show="activeTab === 'custom'" x-cloak class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-4 transition-all">
                        
                        <!-- 1. Card Background Color -->
                        <div class="p-3 rounded-2xl bg-slate-50/80 border border-slate-200/80 space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label class="block text-xs font-bold text-slate-800">Background Layar Kartu</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="color" x-model="cardBg"
                                       class="w-9 h-9 p-0.5 rounded-xl border border-slate-200 cursor-pointer shrink-0">
                                <input type="text" name="theme_card_bg" x-model="cardBg"
                                       class="w-full bg-white border border-slate-200 rounded-xl px-2.5 py-1.5 text-xs font-mono font-semibold text-slate-800">
                            </div>
                        </div>

                        <!-- 2. Card Border / Ribbon Color -->
                        <div class="p-3 rounded-2xl bg-slate-50/80 border border-slate-200/80 space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label class="block text-xs font-bold text-slate-800">Warna Balok Pita & Border</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="color" x-model="cardBorder"
                                       class="w-9 h-9 p-0.5 rounded-xl border border-slate-200 cursor-pointer shrink-0">
                                <input type="text" name="theme_card_border" x-model="cardBorder"
                                       class="w-full bg-white border border-slate-200 rounded-xl px-2.5 py-1.5 text-xs font-mono font-semibold text-slate-800">
                            </div>
                        </div>

                        <!-- 3. Card Text Color -->
                        <div class="p-3 rounded-2xl bg-slate-50/80 border border-slate-200/80 space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label class="block text-xs font-bold text-slate-800">Warna Judul & Teks Kartu</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="color" x-model="cardText"
                                       class="w-9 h-9 p-0.5 rounded-xl border border-slate-200 cursor-pointer shrink-0">
                                <input type="text" name="theme_card_text" x-model="cardText"
                                       class="w-full bg-white border border-slate-200 rounded-xl px-2.5 py-1.5 text-xs font-mono font-semibold text-slate-800">
                            </div>
                        </div>

                        <!-- 4. Button Border Color -->
                        <div class="p-3 rounded-2xl bg-slate-50/80 border border-slate-200/80 space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label class="block text-xs font-bold text-slate-800">Warna Border Tombol</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="color" x-model="buttonBorder"
                                       class="w-9 h-9 p-0.5 rounded-xl border border-slate-200 cursor-pointer shrink-0">
                                <input type="text" name="theme_button_border" x-model="buttonBorder"
                                       class="w-full bg-white border border-slate-200 rounded-xl px-2.5 py-1.5 text-xs font-mono font-semibold text-slate-800">
                            </div>
                        </div>

                        <!-- 5. Button Background Color -->
                        <div class="p-3 rounded-2xl bg-slate-50/80 border border-slate-200/80 space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label class="block text-xs font-bold text-slate-800">Warna Background Tombol</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="color" x-model="buttonBg"
                                       class="w-9 h-9 p-0.5 rounded-xl border border-slate-200 cursor-pointer shrink-0">
                                <input type="text" name="theme_button_bg" x-model="buttonBg"
                                       class="w-full bg-white border border-slate-200 rounded-xl px-2.5 py-1.5 text-xs font-mono font-semibold text-slate-800">
                            </div>
                        </div>

                        <!-- 6. Button Text Color -->
                        <div class="p-3 rounded-2xl bg-slate-50/80 border border-slate-200/80 space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label class="block text-xs font-bold text-slate-800">Warna Teks Tombol (Italic)</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="color" x-model="buttonText"
                                       class="w-9 h-9 p-0.5 rounded-xl border border-slate-200 cursor-pointer shrink-0">
                                <input type="text" name="theme_button_text" x-model="buttonText"
                                       class="w-full bg-white border border-slate-200 rounded-xl px-2.5 py-1.5 text-xs font-mono font-semibold text-slate-800">
                            </div>
                        </div>

                        <!-- 7. Primary Accent Color -->
                        <div class="p-3 rounded-2xl bg-slate-50/80 border border-slate-200/80 space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label class="block text-xs font-bold text-slate-800">Warna Aksen (Primary)</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="color" x-model="primaryColor"
                                       class="w-9 h-9 p-0.5 rounded-xl border border-slate-200 cursor-pointer shrink-0">
                                <input type="text" name="theme_primary" x-model="primaryColor"
                                       class="w-full bg-white border border-slate-200 rounded-xl px-2.5 py-1.5 text-xs font-mono font-semibold text-slate-800">
                            </div>
                        </div>

                        <!-- 8. Page Canvas Background Color -->
                        <div class="p-3 rounded-2xl bg-slate-50/80 border border-slate-200/80 space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label class="block text-xs font-bold text-slate-800">Warna Kanvas Desktop (Body)</label>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="color" x-model="bgColor"
                                       class="w-9 h-9 p-0.5 rounded-xl border border-slate-200 cursor-pointer shrink-0">
                                <input type="text" name="theme_bg" x-model="bgColor"
                                       class="w-full bg-white border border-slate-200 rounded-xl px-2.5 py-1.5 text-xs font-mono font-semibold text-slate-800">
                            </div>
                        </div>

                    </div>
                </div>

                <!-- Left Panel Footer (Matching baseline with preview footer) -->
                <div class="pt-4 mt-5 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <span class="inline-flex items-center gap-1.5">
                        <i data-lucide="sparkles" class="w-3.5 h-3.5 text-amber-500"></i>
                        <span x-show="activeTab === 'presets'">Preset otomatis mengisi skema warna & gaya kartu</span>
                        <span x-show="activeTab === 'custom'">Ubah palet warna di atas untuk pratinjau real-time</span>
                    </span>
                    <span class="text-[11px] font-semibold text-blue-700 bg-blue-50 px-2.5 py-0.5 rounded-full" x-text="presets[themeStyle] ? presets[themeStyle].name : 'Kustom'"></span>
                </div>
            </div>

            <!-- Right: Real-time Live Mini-Card Preview (50% Symmetrical) -->
            <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200/80 shadow-xs flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-2">
                            <i data-lucide="smartphone" class="w-4 h-4 text-blue-600"></i>
                            <h3 class="text-sm font-bold text-slate-900 font-display">Pratinjau Mobile Real-Time</h3>
                        </div>
                        <span class="text-[10px] font-bold text-blue-700 bg-blue-50 px-2.5 py-0.5 rounded-full">
                            Full-Screen Preview
                        </span>
                    </div>

                    <!-- Simulation Device Canvas -->
                    <div class="w-full rounded-2xl p-4 sm:p-5 mt-5 transition-colors duration-300 border border-slate-200/80 shadow-inner flex flex-col items-center justify-center"
                         :style="'background-color: ' + bgColor + ';'">
                        
                        <!-- Simulating The Full-Screen Phone Card Mockup (Symmetrical) -->
                        <div class="w-full max-w-[260px] shadow-2xl border overflow-hidden transition-all duration-300 flex flex-col justify-between select-none"
                             :class="cardRadius"
                             :style="'background-color: ' + cardBg + '; border-color: ' + cardBorder + '; color: ' + cardText + ';'">
                            
                            <!-- Mini Top Status / Indicator Dots (Centered) -->
                            <div class="pt-3 pb-1 px-4 flex items-center justify-center">
                                <div class="flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full shadow-xs" :style="'background-color: ' + cardText + ';'"></span>
                                    <span class="w-1.5 h-1.5 rounded-full" :style="'background-color: ' + cardText + '; opacity: 0.35;'"></span>
                                    <span class="w-1.5 h-1.5 rounded-full" :style="'background-color: ' + cardText + '; opacity: 0.35;'"></span>
                                </div>
                            </div>

                            <!-- Mini Card Header / Content -->
                            <div class="pt-1.5 pb-1 px-3.5 text-center flex flex-col items-center">
                                <!-- Mini Circular White Logo Badge -->
                                <div class="w-13 h-13 rounded-full p-2 bg-white shadow-md mx-auto mb-1.5 border flex items-center justify-center overflow-hidden"
                                     :style="'border-color: ' + cardBorder + ';'">
                                    <img src="{{ asset($settings['logo'] ?? 'assets/logo kiw.png') }}" alt="Logo" class="w-full h-full object-contain">
                                </div>

                                <!-- Mini Title -->
                                <div class="text-[12px] font-bold tracking-wider uppercase font-serif leading-tight"
                                     :style="'color: ' + cardText + ';'">
                                    {{ $settings['short'] ?? 'KIW COMMERCIAL' }}
                                </div>

                                <!-- Mini Subtitle -->
                                <div class="text-[8px] font-serif uppercase tracking-widest mt-1"
                                     :style="'color: ' + cardText + '; opacity: 0.85;'">
                                    INFORMASI RESMI PERSEROAN
                                </div>

                                <!-- Mini Solid Divider Ribbon -->
                                <div class="w-4/5 h-1.5 mx-auto mt-2 mb-2.5 shadow-2xs"
                                     :style="'background-color: ' + cardBorder + ';'"></div>
                            </div>

                            <!-- Mini Button Items (Symmetrical) -->
                            <div class="px-4 pb-3.5 space-y-2">
                                <div class="py-2 px-2.5 border text-center text-[10px] font-serif italic tracking-wide transition-all shadow-2xs"
                                     :style="'background-color: ' + buttonBg + '; color: ' + buttonText + '; border-color: ' + buttonBorder + ';'">
                                    Website Resmi PT KIW
                                </div>

                                <div class="py-2 px-2.5 border text-center text-[10px] font-serif italic tracking-wide transition-all shadow-2xs"
                                     :style="'background-color: ' + buttonBg + '; color: ' + buttonText + '; border-color: ' + buttonBorder + ';'">
                                    WhatsApp Contact Person
                                </div>

                                <div class="py-2 px-2.5 border text-center text-[10px] font-serif italic tracking-wide transition-all shadow-2xs"
                                     :style="'background-color: ' + buttonBg + '; color: ' + buttonText + '; border-color: ' + buttonBorder + ';'">
                                    Petunjuk Arah Google Maps
                                </div>
                            </div>

                            <!-- Mini Footer -->
                            <div class="text-center pb-2">
                                <span class="text-[7px] font-mono tracking-widest uppercase"
                                      :style="'color: ' + cardText + '; opacity: 0.45;'">
                                    {{ $settings['footer_badge'] ?? 'KIW COMMERCIAL' }}
                                </span>
                            </div>

                        </div>

                        <div class="text-center mt-2.5">
                            <span class="text-[10px] font-mono opacity-80"
                                  :style="'color: ' + (themeStyle === 'white_purple' ? '#475569' : '#cbd5e1') + ';'">
                                Pratinjau tampilan kartu full-screen mobile
                            </span>
                        </div>

                    </div>
                </div>

                <!-- Right Panel Footer (Matching baseline with left footer) -->
                <div class="pt-4 mt-5 border-t border-slate-100 text-center">
                    <span class="text-xs text-slate-500 inline-flex items-center gap-1.5">
                        <i data-lucide="smartphone" class="w-3.5 h-3.5 text-slate-400"></i>
                        <span>Visual layar kartu full-screen mobile responsif</span>
                    </span>
                </div>

            </div>

        </div>

        <!-- SECTION 2: PENGATURAN DESAIN KARTU (CARD STYLING) -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center shrink-0">
                    <i data-lucide="layers" class="w-5 h-5"></i>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-900 font-display">2. Pengaturan Gaya Kartu (Card Styling)</h2>
                    <p class="text-xs text-slate-500">Atur bentuk sudut dan kelengkungan kartu landing page pengunjung.</p>
                </div>
            </div>

            <!-- Card Radius Options -->
            <div>
                <label class="block text-xs font-bold text-slate-800 mb-3">Kelengkungan Sudut Kartu (Border Radius)</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
                    
                    <label @click="cardRadius = 'rounded-none'"
                           :class="cardRadius === 'rounded-none' ? 'border-blue-600 bg-blue-50/40 text-blue-900 ring-2 ring-blue-500/20' : 'border-slate-200 hover:border-blue-200 text-slate-700'"
                           class="p-4 rounded-xl border-2 cursor-pointer transition-all flex flex-col items-center justify-center text-center">
                        <input type="radio" value="rounded-none" class="sr-only" x-model="cardRadius">
                        <div class="w-12 h-8 rounded-none border-2 border-dashed border-blue-400 mb-2"></div>
                        <span class="text-xs font-bold">Tegak Persegi</span>
                        <span class="text-[10px] text-slate-400 font-mono">0px (rounded-none)</span>
                    </label>

                    <label @click="cardRadius = 'rounded-xl'"
                           :class="cardRadius === 'rounded-xl' ? 'border-blue-600 bg-blue-50/40 text-blue-900 ring-2 ring-blue-500/20' : 'border-slate-200 hover:border-blue-200 text-slate-700'"
                           class="p-4 rounded-xl border-2 cursor-pointer transition-all flex flex-col items-center justify-center text-center">
                        <input type="radio" value="rounded-xl" class="sr-only" x-model="cardRadius">
                        <div class="w-12 h-8 rounded-xl border-2 border-dashed border-blue-400 mb-2"></div>
                        <span class="text-xs font-bold">Minimalis</span>
                        <span class="text-[10px] text-slate-400 font-mono">12px (rounded-xl)</span>
                    </label>

                    <label @click="cardRadius = 'rounded-2xl'"
                           :class="cardRadius === 'rounded-2xl' ? 'border-blue-600 bg-blue-50/40 text-blue-900 ring-2 ring-blue-500/20' : 'border-slate-200 hover:border-blue-200 text-slate-700'"
                           class="p-4 rounded-2xl border-2 cursor-pointer transition-all flex flex-col items-center justify-center text-center">
                        <input type="radio" value="rounded-2xl" class="sr-only" x-model="cardRadius">
                        <div class="w-12 h-8 rounded-2xl border-2 border-dashed border-blue-400 mb-2"></div>
                        <span class="text-xs font-bold">Elegan</span>
                        <span class="text-[10px] text-slate-400 font-mono">16px (rounded-2xl)</span>
                    </label>

                    <label @click="cardRadius = 'rounded-[28px]'"
                           :class="cardRadius === 'rounded-[28px]' ? 'border-blue-600 bg-blue-50/40 text-blue-900 ring-2 ring-blue-500/20' : 'border-slate-200 hover:border-blue-200 text-slate-700'"
                           class="p-4 rounded-2xl border-2 cursor-pointer transition-all flex flex-col items-center justify-center text-center">
                        <input type="radio" value="rounded-[28px]" class="sr-only" x-model="cardRadius">
                        <div class="w-12 h-8 rounded-[20px] border-2 border-dashed border-blue-500 mb-2"></div>
                        <span class="text-xs font-bold">Kurva Modern</span>
                        <span class="text-[10px] text-slate-400 font-mono">28px (rounded-28px)</span>
                    </label>

                    <label @click="cardRadius = 'rounded-[36px]'"
                           :class="cardRadius === 'rounded-[36px]' ? 'border-blue-600 bg-blue-50/40 text-blue-900 ring-2 ring-blue-500/20' : 'border-slate-200 hover:border-blue-200 text-slate-700'"
                           class="p-4 rounded-3xl border-2 cursor-pointer transition-all flex flex-col items-center justify-center text-center">
                        <input type="radio" value="rounded-[36px]" class="sr-only" x-model="cardRadius">
                        <div class="w-12 h-8 rounded-[26px] border-2 border-dashed border-blue-400 mb-2"></div>
                        <span class="text-xs font-bold">Sangat Bulat</span>
                        <span class="text-[10px] text-slate-400 font-mono">36px (rounded-36px)</span>
                    </label>

                </div>
            </div>

            <!-- Direct Link to Card Content Management -->
            <div class="p-4 rounded-2xl bg-blue-50/50 border border-blue-100 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0">
                        <i data-lucide="layers" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-slate-900">Ingin Mengatur Urutan & Isi Tombol Tiap Kartu?</div>
                        <div class="text-[11px] text-slate-500">Anda dapat menambah, mengedit, atau menghapus kartu serta tombol di dalamnya pada menu Kelola Kartu.</div>
                    </div>
                </div>
                <a href="{{ route('admin.slides.index') }}" class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition-all shadow-xs shrink-0 inline-flex items-center gap-1.5 self-start sm:self-auto">
                    <span>Buka Pengaturan Kartu</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
        </div>

        <!-- SECTION 3: BRAND & IDENTITAS PERSEROAN -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center shrink-0">
                    <i data-lucide="building" class="w-5 h-5"></i>
                </div>
                <div>
                    <h2 class="text-base font-bold text-slate-900 font-display">3. Brand & Identitas Utama</h2>
                    <p class="text-xs text-slate-500">Logo resmi perusahaan, judul header kartu, nomor WhatsApp tujuan pesan, serta teks badge footer.</p>
                </div>
            </div>

            <!-- Logo Upload -->
            <div class="p-4 rounded-2xl bg-slate-50/70 border border-slate-200/80">
                <label class="block text-xs font-bold text-slate-800 mb-2">Logo Resmi Perusahaan (.PNG / .SVG)</label>
                <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-white border border-slate-200 p-2 flex items-center justify-center shrink-0 shadow-sm">
                        <img src="{{ asset($settings['logo'] ?? 'assets/logo kiw.png') }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                    <div class="flex-1 min-w-0">
                        <input type="file" name="logo_file" accept="image/*"
                               class="text-xs text-slate-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                        <p class="text-[11px] text-slate-400 mt-1.5">Gunakan gambar berlatar transparan dengan resolusi minimal 200x200 pixel.</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Resmi Perseroan *</label>
                    <input type="text" name="name" value="{{ old('name', $settings['name'] ?? '') }}" required
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                    <span class="text-[10px] text-slate-400">Nama lengkap entitas perusahaan (alt logo & SEO)</span>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Judul Singkat / Header Kartu *</label>
                    <input type="text" name="short" value="{{ old('short', $settings['short'] ?? '') }}" required
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                    <span class="text-[10px] text-slate-400">Teks judul di atas kartu & pratinjau saat link dibagikan</span>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor WhatsApp CS / Marketing (Format: 628xxx) *</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp', $settings['whatsapp'] ?? '') }}" required placeholder="Contoh: 628112345678"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 font-mono focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                    <span class="text-[10px] text-slate-400">Tujuan kirim pesan otomatis pada tombol modal pop-up</span>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Teks Badge Footer</label>
                    <input type="text" name="footer_badge" value="{{ old('footer_badge', $settings['footer_badge'] ?? '') }}" placeholder="Contoh: KIW COMMERCIAL"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                    <span class="text-[10px] text-slate-400">Label teks kecil di bagian paling bawah layar kartu</span>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Tagline Kawasan Industri (SEO Tab Title)</label>
                <input type="text" name="tagline" value="{{ old('tagline', $settings['tagline'] ?? '') }}" placeholder="Contoh: Integrated & Sustainable Industrial Estate"
                       class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-sm text-slate-800 focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                <span class="text-[10px] text-slate-400">Keterangan slogan pendamping di tab browser pengunjung</span>
            </div>

            <!-- Hidden Inputs to preserve existing data safely -->
            <input type="hidden" name="phone" value="{{ $settings['phone'] ?? '' }}">
            <input type="hidden" name="email" value="{{ $settings['email'] ?? '' }}">
            <input type="hidden" name="website" value="{{ $settings['website'] ?? '' }}">
            <input type="hidden" name="address" value="{{ $settings['address'] ?? '' }}">
            <input type="hidden" name="whatsapp_display" value="{{ $settings['whatsapp_display'] ?? '' }}">
        </div>

        <!-- Sticky Bottom Submit Button Bar -->
        <div class="flex items-center justify-between gap-4 pt-2 pb-6">
            <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-100 text-xs font-semibold text-slate-700 transition-colors">
                Batal
            </a>
            <button type="submit"
                    class="px-7 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition-all shadow-lg shadow-blue-600/25 active:scale-[0.99] flex items-center gap-2 cursor-pointer">
                <i data-lucide="check" class="w-4 h-4"></i>
                <span>Simpan Perubahan</span>
            </button>
        </div>

    </form>

</div>
@endsection
