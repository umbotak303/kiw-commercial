<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>{{ $settings['short'] ?? 'KIW COMMERCIAL' }} — {{ $settings['tagline'] ?? 'Integrated Industrial Estate' }}</title>
    
    <!-- Meta SEO & OpenGraph -->
    <meta name="description" content="Portal Link Resmi KIW Commercial: Konsultasi Investasi Lahan, SFB Siap Pakai, Pergudangan Logistik, dan Akses Strategis.">
    <meta property="og:title" content="{{ $settings['short'] ?? 'KIW COMMERCIAL' }} — Portal Resmi">
    <meta property="og:description" content="Layanan Cepat & Informasi Kawasan Industri Wijayakusuma.">
    <meta property="og:type" content="website">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset($settings['logo'] ?? 'assets/logo kiw.png') }}">

    <!-- Google Fonts: Playfair Display (Serif), Cinzel, Plus Jakarta Sans, & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,400;1,500;1,600;1,700&family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @php
        $themeStyle = $settings['theme_style'] ?? 'corporate_navy';

        // Definisi konfigurasi warna tiap preset tema
        $themePalettes = [
            'maroon_gold' => [
                'bg_body' => '#181f2a',
                'card_bg' => '#3a0e05',
                'card_text' => '#ffffff',
                'card_border' => '#a67c2e',
                'primary' => '#a67c2e',
                'primary_hover' => '#8c6520',
                'primary_light' => 'rgba(166, 124, 46, 0.2)',
                'primary_border' => '#a67c2e',
                'button_bg' => 'rgba(0, 0, 0, 0.22)',
                'button_text' => '#ffffff',
                'button_border' => '#a67c2e',
                'accent_grad' => 'from-amber-600 via-yellow-500 to-amber-700',
                'glow1' => 'rgba(166, 124, 46, 0.12)',
                'glow2' => 'rgba(217, 119, 6, 0.12)',
                'card_radius' => 'rounded-[28px]',
                'is_dark' => true,
            ],
            'corporate_navy' => [
                'bg_body' => '#070d18',
                'card_bg' => '#0f172a',
                'card_text' => '#f1f5f9',
                'card_border' => '#0ea5e9',
                'primary' => '#0ea5e9',
                'primary_hover' => '#0284c7',
                'primary_light' => 'rgba(14, 165, 233, 0.12)',
                'primary_border' => 'rgba(14, 165, 233, 0.3)',
                'button_bg' => 'rgba(0, 0, 0, 0.25)',
                'button_text' => '#f8fafc',
                'button_border' => '#0ea5e9',
                'accent_grad' => 'from-sky-400 via-blue-500 to-indigo-500',
                'glow1' => 'rgba(14, 165, 233, 0.15)',
                'glow2' => 'rgba(99, 102, 241, 0.15)',
                'card_radius' => 'rounded-[28px]',
                'is_dark' => true,
            ],
            'white_purple' => [
                'bg_body' => '#f1f5f9',
                'card_bg' => '#ffffff',
                'card_text' => '#1e293b',
                'card_border' => '#7c3aed',
                'primary' => '#7c3aed',
                'primary_hover' => '#6d28d9',
                'primary_light' => '#f5f3ff',
                'primary_border' => '#ddd6fe',
                'button_bg' => '#f8fafc',
                'button_text' => '#1e293b',
                'button_border' => '#7c3aed',
                'accent_grad' => 'from-purple-500 via-indigo-600 to-violet-500',
                'glow1' => 'rgba(124, 58, 237, 0.08)',
                'glow2' => 'rgba(99, 102, 241, 0.08)',
                'card_radius' => 'rounded-[28px]',
                'is_dark' => false,
            ],
            'emerald_green' => [
                'bg_body' => '#041f17',
                'card_bg' => '#064e3b',
                'card_text' => '#ffffff',
                'card_border' => '#10b981',
                'primary' => '#10b981',
                'primary_hover' => '#059669',
                'primary_light' => '#ecfdf5',
                'primary_border' => '#a7f3d0',
                'button_bg' => 'rgba(0, 0, 0, 0.22)',
                'button_text' => '#ffffff',
                'button_border' => '#10b981',
                'accent_grad' => 'from-emerald-500 via-teal-600 to-cyan-500',
                'glow1' => 'rgba(16, 185, 129, 0.08)',
                'glow2' => 'rgba(20, 184, 166, 0.08)',
                'card_radius' => 'rounded-[28px]',
                'is_dark' => true,
            ],
            'royal_blue' => [
                'bg_body' => '#f0f7ff',
                'card_bg' => '#172554',
                'card_text' => '#ffffff',
                'card_border' => '#60a5fa',
                'primary' => '#2563eb',
                'primary_hover' => '#1d4ed8',
                'primary_light' => '#eff6ff',
                'primary_border' => '#bfdbfe',
                'button_bg' => 'rgba(0, 0, 0, 0.2)',
                'button_text' => '#ffffff',
                'button_border' => '#60a5fa',
                'accent_grad' => 'from-blue-500 via-indigo-600 to-sky-500',
                'glow1' => 'rgba(37, 99, 235, 0.08)',
                'glow2' => 'rgba(14, 165, 233, 0.08)',
                'card_radius' => 'rounded-[28px]',
                'is_dark' => true,
            ],
            'dark_slate' => [
                'bg_body' => '#18181b',
                'card_bg' => '#27272a',
                'card_text' => '#fafafa',
                'card_border' => '#eab308',
                'primary' => '#eab308',
                'primary_hover' => '#ca8a04',
                'primary_light' => 'rgba(234, 179, 8, 0.15)',
                'primary_border' => 'rgba(234, 179, 8, 0.3)',
                'button_bg' => 'rgba(0, 0, 0, 0.3)',
                'button_text' => '#fafafa',
                'button_border' => '#eab308',
                'accent_grad' => 'from-amber-400 via-yellow-500 to-amber-600',
                'glow1' => 'rgba(234, 179, 8, 0.12)',
                'glow2' => 'rgba(245, 158, 11, 0.12)',
                'card_radius' => 'rounded-[28px]',
                'is_dark' => true,
            ],
            'modern_minimalist' => [
                'bg_body' => '#fafafa',
                'card_bg' => '#ffffff',
                'card_text' => '#18181b',
                'card_border' => '#4f46e5',
                'primary' => '#4f46e5',
                'primary_hover' => '#4338ca',
                'primary_light' => '#eef2ff',
                'primary_border' => '#c7d2fe',
                'button_bg' => '#ffffff',
                'button_text' => '#18181b',
                'button_border' => '#4f46e5',
                'accent_grad' => 'from-indigo-500 via-purple-600 to-violet-500',
                'glow1' => 'rgba(79, 70, 229, 0.06)',
                'glow2' => 'rgba(124, 58, 237, 0.06)',
                'card_radius' => 'rounded-[20px]',
                'is_dark' => false,
            ],
        ];

        $currentTheme = $themePalettes[$themeStyle] ?? $themePalettes['corporate_navy'];

        // Overrides kustom dari database settings
        if (!empty($settings['theme_primary'])) {
            $currentTheme['primary'] = $settings['theme_primary'];
        }
        if (!empty($settings['theme_bg'])) {
            $currentTheme['bg_body'] = $settings['theme_bg'];
        }
        if (!empty($settings['theme_card_bg'])) {
            $currentTheme['card_bg'] = $settings['theme_card_bg'];
        }
        if (!empty($settings['theme_card_text'])) {
            $currentTheme['card_text'] = $settings['theme_card_text'];
        }
        if (!empty($settings['theme_card_border'])) {
            $currentTheme['card_border'] = $settings['theme_card_border'];
        }
        if (!empty($settings['theme_card_radius'])) {
            $currentTheme['card_radius'] = $settings['theme_card_radius'];
        }
        if (!empty($settings['theme_button_bg'])) {
            $currentTheme['button_bg'] = $settings['theme_button_bg'];
        }
        if (!empty($settings['theme_button_text'])) {
            $currentTheme['button_text'] = $settings['theme_button_text'];
        }
        if (!empty($settings['theme_button_border'])) {
            $currentTheme['button_border'] = $settings['theme_button_border'];
        }

        $rawRadius = $currentTheme['card_radius'] ?? 'rounded-[28px]';
        $pixelRadius = '28px';
        if (preg_match('/rounded-\[([0-9]+px)\]/', $rawRadius, $matches)) {
            $pixelRadius = $matches[1];
        }
    @endphp

    <style>
        :root {
            --theme-primary: {{ $currentTheme['primary'] }};
            --theme-primary-hover: {{ $currentTheme['primary_hover'] ?? $currentTheme['primary'] }};
            --theme-primary-light: {{ $currentTheme['primary_light'] ?? 'rgba(166, 124, 46, 0.15)' }};
            --theme-primary-border: {{ $currentTheme['primary_border'] ?? '#a67c2e' }};
            --theme-card-bg: {{ $currentTheme['card_bg'] }};
            --theme-card-text: {{ $currentTheme['card_text'] }};
            --theme-card-border: {{ $currentTheme['card_border'] }};
            --theme-btn-bg: {{ $currentTheme['button_bg'] }};
            --theme-btn-text: {{ $currentTheme['button_text'] }};
            --theme-btn-border: {{ $currentTheme['button_border'] }};
            --theme-card-radius: {{ $pixelRadius }};
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: {{ $currentTheme['bg_body'] }};
            -webkit-tap-highlight-color: transparent;
            overflow-x: hidden;
        }
        .main-card-frame {
            width: 100%;
            height: 100vh;
            height: 100dvh;
            border-radius: 0;
            border-width: 0;
        }
        @media (min-width: 768px) {
            .main-card-frame {
                height: 90vh;
                max-height: 890px;
                min-height: 700px;
                max-width: 480px;
                border-radius: var(--theme-card-radius, 28px);
                border-width: 1px;
            }
        }
        @media (min-width: 1024px) {
            .main-card-frame {
                max-width: 500px;
            }
        }
        .font-serif {
            font-family: 'Playfair Display', Georgia, Cambria, 'Times New Roman', serif;
        }
        .font-cinzel {
            font-family: 'Cinzel', 'Playfair Display', Georgia, serif;
        }
        .font-display {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .min-screen-h {
            min-height: 100vh;
            min-height: 100dvh;
        }
        .theme-primary-text {
            color: var(--theme-primary) !important;
        }
        .theme-primary-bg {
            background-color: var(--theme-primary) !important;
        }
        .theme-primary-border {
            border-color: var(--theme-primary-border) !important;
        }
        .theme-primary-light-bg {
            background-color: var(--theme-primary-light) !important;
        }
    </style>
</head>
<body class="min-h-screen text-slate-800 antialiased selection:bg-amber-600 selection:text-white flex items-center justify-center p-0 md:p-6 lg:p-8"
      @keydown.arrow-right.window="nextSlide()"
      @keydown.arrow-left.window="prevSlide()"
      x-data="{
          activeSlide: 0,
          totalSlides: {{ count($slides) }},
          touchStartX: 0,
          touchStartY: 0,
          touchEndX: 0,
          touchEndY: 0,
          inquiryModalOpen: false,
          detailModalOpen: false,
          activeDetail: { title: '', badge: '', subtitle: '', content: '' },
          toast: { show: false, message: '' },
          form: {
              name: '',
              company: '',
              phone: '',
              interest: 'Kavling Industri Siap Bangun',
              message: ''
          },
          
          nextSlide() {
              if (this.totalSlides <= 1) return;
              if (this.activeSlide < this.totalSlides - 1) {
                  this.activeSlide++;
              } else {
                  this.activeSlide = 0;
              }
              this.$nextTick(() => window.refreshIcons && window.refreshIcons());
          },
          prevSlide() {
              if (this.totalSlides <= 1) return;
              if (this.activeSlide > 0) {
                  this.activeSlide--;
              } else {
                  this.activeSlide = this.totalSlides - 1;
              }
              this.$nextTick(() => window.refreshIcons && window.refreshIcons());
          },
          goToSlide(index) {
              this.activeSlide = index;
              this.$nextTick(() => window.refreshIcons && window.refreshIcons());
          },
          handleTouchStart(e) {
              this.touchStartX = e.changedTouches[0].screenX;
              this.touchStartY = e.changedTouches[0].screenY;
          },
          handleTouchEnd(e) {
              this.touchEndX = e.changedTouches[0].screenX;
              this.touchEndY = e.changedTouches[0].screenY;
              this.handleGesture();
          },
          handleGesture() {
              const diffX = this.touchEndX - this.touchStartX;
              const diffY = this.touchEndY - this.touchStartY;
              if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 40) {
                  if (diffX < 0) {
                      this.nextSlide();
                  } else {
                      this.prevSlide();
                  }
              }
          },
          openInquiry(interest = '') {
              if (interest) this.form.interest = interest;
              this.inquiryModalOpen = true;
          },
          openDetail(title, badge, subtitle, content) {
              this.activeDetail = { title, badge, subtitle, content };
              this.detailModalOpen = true;
          },
          showToast(msg) {
              this.toast.message = msg;
              this.toast.show = true;
              setTimeout(() => this.toast.show = false, 3500);
          },
          sendToWhatsApp() {
              if (!this.form.name || !this.form.phone) {
                  alert('Mohon isi nama dan nomor telepon Anda.');
                  return;
              }
              const text = `Halo Tim Marketing KIW,%0ANama: ${encodeURIComponent(this.form.name)}%0APerusahaan: ${encodeURIComponent(this.form.company || '-')}%0ANo. Kontak: ${encodeURIComponent(this.form.phone)}%0AKebutuhan: ${encodeURIComponent(this.form.interest)}%0ACatatan: ${encodeURIComponent(this.form.message || '-')}`;
              const waUrl = `https://wa.me/{{ $settings['whatsapp'] ?? '628112345678' }}?text=${text}`;
              window.open(waUrl, '_blank');
              this.inquiryModalOpen = false;
              this.showToast('Menghubungkan ke WhatsApp Marketing KIW...');
          },
          sharePage() {
              if (navigator.share) {
                  navigator.share({
                      title: '{{ $settings['short'] ?? 'KIW Commercial' }}',
                      text: 'Hubungi Marketing & Cek Informasi Kawasan Industri Wijayakusuma:',
                      url: window.location.href
                  }).catch(() => {});
              } else {
                  navigator.clipboard.writeText(window.location.href);
                  this.showToast('Link berhasil disalin ke clipboard!');
              }
          }
      }">

    <!-- FULL CARD CONTAINER (Mobile Fullscreen / Desktop Phone Frame) -->
    <main class="main-card-frame rounded-none md:{{ $currentTheme['card_radius'] ?? 'rounded-[28px]' }} relative overflow-hidden flex flex-col justify-between select-none md:shadow-2xl md:border md:ring-1 md:ring-black/40"
          style="background-color: var(--theme-card-bg); color: var(--theme-card-text); border-color: var(--theme-card-border);">

        <!-- TOP BAR: Safe area header with dots indicator -->
        <header class="w-full pt-[max(0.75rem,env(safe-area-inset-top,0.75rem))] pb-1 px-4 sm:px-6 flex items-center justify-center shrink-0 z-30 select-none">
            @if(count($slides) > 1)
                <!-- Slide Dots Indicator -->
                <div class="flex items-center justify-center gap-2">
                    @for($i = 0; $i < count($slides); $i++)
                        <button @click="goToSlide({{ $i }})"
                                aria-label="Slide {{ $i + 1 }}"
                                class="transition-all duration-300 rounded-full cursor-pointer"
                                :class="activeSlide === {{ $i }} ? 'w-5 h-2 shadow-xs' : 'w-2 h-2 hover:opacity-100'"
                                :style="activeSlide === {{ $i }} ? 'background-color: var(--theme-card-text);' : 'background-color: var(--theme-card-text); opacity: 0.35;'">
                        </button>
                    @endfor
                </div>
            @endif
        </header>

        <!-- FLOATING SIDE NAVIGATION ARROWS (Desktop Only: Placed on outer sides of the card) -->
        @if(count($slides) > 1)
            <!-- Desktop Left Arrow (Prev Slide) -->
            <button @click="prevSlide()"
                    aria-label="Slide Sebelumnya"
                    class="hidden md:flex absolute -left-14 lg:-left-16 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-slate-900/85 hover:bg-slate-900 text-white items-center justify-center shadow-xl border border-white/20 transition-all duration-200 hover:scale-110 active:scale-95 z-30 cursor-pointer">
                <i data-lucide="chevron-left" class="w-6 h-6"></i>
            </button>

            <!-- Desktop Right Arrow (Next Slide) -->
            <button @click="nextSlide()"
                    aria-label="Slide Berikutnya"
                    class="hidden md:flex absolute -right-14 lg:-right-16 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-slate-900/85 hover:bg-slate-900 text-white items-center justify-center shadow-xl border border-white/20 transition-all duration-200 hover:scale-110 active:scale-95 z-30 cursor-pointer">
                <i data-lucide="chevron-right" class="w-6 h-6"></i>
            </button>
        @endif

        <!-- HORIZONTAL SLIDES CAROUSEL TRACK -->
        <div class="relative w-full flex-1 overflow-hidden min-h-0"
             @touchstart="handleTouchStart($event)"
             @touchend="handleTouchEnd($event)">
            
            <div class="w-full h-full flex transition-transform duration-300 ease-out"
                 :style="'transform: translateX(-' + (activeSlide * 100) + '%);'">
                
                @foreach($slides as $slideIndex => $slide)
                    @php
                        $slideCardBg = !empty($slide['card_bg']) ? $slide['card_bg'] : null;
                        $slideCardText = !empty($slide['card_text']) ? $slide['card_text'] : null;
                    @endphp

                    <div class="w-full h-full shrink-0 flex flex-col justify-between px-4 sm:px-6 md:px-8 py-2 overflow-y-auto overscroll-contain no-scrollbar"
                         style="@if($slideCardBg) background-color: {{ $slideCardBg }}; @endif @if($slideCardText) color: {{ $slideCardText }}; @endif">
                        
                        <!-- UPPER SECTION: LOGO + TITLE + SUBTITLE + GOLD DIVIDER -->
                        <div class="w-full flex flex-col items-center text-center shrink-0 pt-1 sm:pt-2">
                            
                            <!-- Circular White Logo Badge -->
                            <div class="w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32 rounded-full bg-white shadow-xl flex items-center justify-center p-3 sm:p-4 mx-auto border-2 border-[var(--theme-card-border)]/40 shrink-0 select-none transition-transform">
                                <img src="{{ asset($settings['logo'] ?? 'assets/logo kiw.png') }}"
                                     alt="{{ $settings['name'] ?? 'Logo' }}"
                                     class="w-full h-full object-contain filter drop-shadow-xs select-none pointer-events-none">
                            </div>

                            <!-- Main Card Title -->
                            <h1 class="font-serif font-bold text-xl sm:text-2xl md:text-3xl tracking-wider text-center uppercase mt-3 sm:mt-4 mb-1 sm:mb-1.5 leading-tight px-2"
                                style="color: var(--theme-card-text);">
                                {{ $slide['title'] }}
                            </h1>

                            <!-- Subtitle / Slide Prompt -->
                            @if(!empty($slide['subtitle']))
                                <p class="font-serif font-medium text-xs sm:text-[13px] tracking-[0.14em] sm:tracking-[0.16em] text-center uppercase mb-2.5 sm:mb-3 px-2"
                                    style="color: var(--theme-card-text); opacity: 0.9;">
                                    {{ $slide['subtitle'] }}
                                </p>
                            @endif

                            <!-- Solid Golden Divider Bar -->
                            <div class="w-3/4 max-w-[220px] sm:max-w-[260px] h-2.5 sm:h-3.5 mx-auto mb-3 sm:mb-5 shadow-xs"
                                 style="background-color: var(--theme-card-border);"></div>
                        </div>

                        <!-- MIDDLE SECTION: FRAMED BUTTON LIST -->
                        <div class="w-full max-w-[390px] sm:max-w-[420px] mx-auto space-y-2.5 sm:space-y-3.5 py-1 sm:py-2">
                            @foreach($slide['items'] as $item)
                                @if(($item['action_type'] ?? '') === 'whatsapp')
                                    <!-- WhatsApp Action -->
                                    <a href="{{ $item['url'] }}" target="_blank"
                                       class="group block w-full py-3 sm:py-3.5 md:py-4 px-4 sm:px-5 border transition-all duration-200 active:scale-[0.99] shadow-xs cursor-pointer text-center hover:opacity-90 rounded-sm"
                                       style="background-color: var(--theme-btn-bg); border-color: var(--theme-btn-border); color: var(--theme-btn-text);">
                                        <span class="block font-serif italic text-sm sm:text-[15px] md:text-base leading-snug tracking-wide break-words"
                                              style="color: var(--theme-btn-text);">
                                            {{ $item['title'] }}
                                        </span>
                                    </a>

                                @elseif(($item['action_type'] ?? '') === 'modal_inquiry')
                                    <!-- Inquiry Modal Action -->
                                    <button @click="openInquiry('{{ addslashes($item['title']) }}')"
                                            class="group block w-full py-3 sm:py-3.5 md:py-4 px-4 sm:px-5 border transition-all duration-200 active:scale-[0.99] shadow-xs cursor-pointer text-center hover:opacity-90 rounded-sm"
                                            style="background-color: var(--theme-btn-bg); border-color: var(--theme-btn-border); color: var(--theme-btn-text);">
                                        <span class="block font-serif italic text-sm sm:text-[15px] md:text-base leading-snug tracking-wide break-words"
                                              style="color: var(--theme-btn-text);">
                                            {{ $item['title'] }}
                                        </span>
                                    </button>

                                @elseif(($item['action_type'] ?? '') === 'call')
                                    <!-- Direct Call Action -->
                                    @php
                                        $callUrl = $item['url'] ?? '';
                                        if ($callUrl && !str_starts_with($callUrl, 'tel:')) {
                                            $cleanNumber = preg_replace('/[^0-9+]/', '', $callUrl);
                                            $callUrl = 'tel:' . $cleanNumber;
                                        }
                                    @endphp
                                    <a href="{{ $callUrl }}"
                                       class="group block w-full py-3 sm:py-3.5 md:py-4 px-4 sm:px-5 border transition-all duration-200 active:scale-[0.99] shadow-xs cursor-pointer text-center hover:opacity-90 rounded-sm"
                                       style="background-color: var(--theme-btn-bg); border-color: var(--theme-btn-border); color: var(--theme-btn-text);">
                                        <span class="block font-serif italic text-sm sm:text-[15px] md:text-base leading-snug tracking-wide break-words"
                                              style="color: var(--theme-btn-text);">
                                            {{ $item['title'] }}
                                        </span>
                                    </a>

                                @elseif(($item['action_type'] ?? '') === 'modal_detail')
                                    <!-- Detail Modal Action -->
                                    <button @click="openDetail('{{ addslashes($item['title']) }}', '{{ addslashes($item['badge'] ?? '') }}', '{{ addslashes($item['subtitle'] ?? '') }}', '{{ addslashes($item['detail_content'] ?? '') }}')"
                                            class="group block w-full py-3 sm:py-3.5 md:py-4 px-4 sm:px-5 border transition-all duration-200 active:scale-[0.99] shadow-xs cursor-pointer text-center hover:opacity-90 rounded-sm"
                                            style="background-color: var(--theme-btn-bg); border-color: var(--theme-btn-border); color: var(--theme-btn-text);">
                                        <span class="block font-serif italic text-sm sm:text-[15px] md:text-base leading-snug tracking-wide break-words"
                                              style="color: var(--theme-btn-text);">
                                            {{ $item['title'] }}
                                        </span>
                                    </button>

                                @elseif(($item['action_type'] ?? '') === 'email')
                                    <!-- Direct Email Action -->
                                    @php
                                        $mailUrl = $item['url'] ?? '';
                                        if ($mailUrl && !str_starts_with($mailUrl, 'mailto:')) {
                                            $mailUrl = 'mailto:' . trim($mailUrl);
                                        }
                                    @endphp
                                    <a href="{{ $mailUrl }}"
                                       class="group block w-full py-3 sm:py-3.5 md:py-4 px-4 sm:px-5 border transition-all duration-200 active:scale-[0.99] shadow-xs cursor-pointer text-center hover:opacity-90 rounded-sm"
                                       style="background-color: var(--theme-btn-bg); border-color: var(--theme-btn-border); color: var(--theme-btn-text);">
                                        <span class="block font-serif italic text-sm sm:text-[15px] md:text-base leading-snug tracking-wide break-words"
                                              style="color: var(--theme-btn-text);">
                                            {{ $item['title'] }}
                                        </span>
                                    </a>

                                @else
                                    <!-- Maps / External Link Action -->
                                    <a href="{{ $item['url'] }}" target="_blank"
                                       class="group block w-full py-3 sm:py-3.5 md:py-4 px-4 sm:px-5 border transition-all duration-200 active:scale-[0.99] shadow-xs cursor-pointer text-center hover:opacity-90 rounded-sm"
                                       style="background-color: var(--theme-btn-bg); border-color: var(--theme-btn-border); color: var(--theme-btn-text);">
                                        <span class="block font-serif italic text-sm sm:text-[15px] md:text-base leading-snug tracking-wide break-words"
                                              style="color: var(--theme-btn-text);">
                                            {{ $item['title'] }}
                                        </span>
                                    </a>
                                @endif
                            @endforeach
                        </div>

                        <!-- EMPTY BOTTOM SPACER FOR BALANCED FLEX SPACING -->
                        <div class="w-full h-1 shrink-0"></div>

                    </div>
                @endforeach

            </div>
        </div>

        <!-- BOTTOM BAR: Navigation Controls (Prev/Next on Mobile) + Footer Link -->
        <footer class="w-full px-4 sm:px-6 pt-1.5 pb-[max(0.75rem,env(safe-area-inset-bottom,0.75rem))] flex items-center justify-between shrink-0 z-30 select-none">
            @if(count($slides) > 1)
                <!-- Mobile Prev Slide Button -->
                <button @click="prevSlide()"
                        aria-label="Slide Sebelumnya"
                        class="md:hidden flex items-center justify-center w-9 h-9 rounded-full bg-black/35 hover:bg-black/55 active:bg-black/75 text-white border border-white/15 active:scale-95 transition-all cursor-pointer shadow-sm">
                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                </button>
            @else
                <div class="w-9 md:hidden"></div>
            @endif

            <!-- Centered Footer Badge Link -->
            <div class="flex-1 text-center px-2">
                <a href="{{ route('admin.dashboard') }}" title="Panel Admin"
                   class="text-[10px] sm:text-[11px] tracking-widest font-mono uppercase hover:opacity-100 transition-opacity inline-block"
                   style="color: var(--theme-card-text); opacity: 0.5;">
                    {{ $settings['footer_badge'] ?? 'KIW COMMERCIAL' }}
                </a>
            </div>

            @if(count($slides) > 1)
                <!-- Mobile Next Slide Button -->
                <button @click="nextSlide()"
                        aria-label="Slide Berikutnya"
                        class="md:hidden flex items-center justify-center w-9 h-9 rounded-full bg-black/35 hover:bg-black/55 active:bg-black/75 text-white border border-white/15 active:scale-95 transition-all cursor-pointer shadow-sm">
                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                </button>
            @else
                <div class="w-9 md:hidden"></div>
            @endif
        </footer>
    </main>

    <!-- INQUIRY / BOOKING MODAL (Direct to WhatsApp) -->
    <div x-show="inquiryModalOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-xs"
         style="display: none;"
         @keydown.escape.window="inquiryModalOpen = false">

        <div @click.outside="inquiryModalOpen = false"
             class="w-full max-w-md bg-white border border-slate-200 text-slate-800 rounded-2xl shadow-2xl p-5 sm:p-6 relative max-h-[90dvh] overflow-y-auto">
            
            <button @click="inquiryModalOpen = false" class="absolute top-4 right-4 p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>

            <div class="text-left mb-5">
                <span class="inline-block px-2.5 py-0.5 rounded-md text-[10px] font-bold bg-amber-100 text-amber-800 mb-2 font-mono">
                    Official KIW Booking
                </span>
                <h3 class="font-display text-lg font-bold text-slate-900">Jadwalkan Survei / Konsultasi</h3>
                <p class="text-xs text-slate-500 mt-1">
                    Silakan isi data kebutuhan kavling/bangunan pabrik Anda. Tim representatif KIW akan segera membalas via WhatsApp.
                </p>
            </div>

            <form @submit.prevent="sendToWhatsApp()" class="space-y-3.5 text-left text-xs">
                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Lengkap *</label>
                    <input type="text" x-model="form.name" required placeholder="Contoh: Budi Santoso"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-slate-800 focus:outline-none focus:border-amber-600 focus:bg-white transition-all text-xs">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nama Perusahaan / Bisnis</label>
                    <input type="text" x-model="form.company" placeholder="Contoh: PT Manufaktur Bersama"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-slate-800 focus:outline-none focus:border-amber-600 focus:bg-white transition-all text-xs">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Nomor WhatsApp Aktif *</label>
                    <input type="tel" x-model="form.phone" required placeholder="Contoh: 0812-3456-7890"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-slate-800 focus:outline-none focus:border-amber-600 focus:bg-white transition-all text-xs">
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Pilihan Unit / Minat Fasilitas</label>
                    <select x-model="form.interest"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-slate-800 focus:outline-none focus:border-amber-600 focus:bg-white transition-all text-xs">
                        <option value="Kavling Industri Siap Bangun">Kavling Industri Siap Bangun (1 - 10 Ha)</option>
                        <option value="Sewa Bangunan Pabrik Siap Pakai (SFB)">Sewa Bangunan Pabrik Siap Pakai (SFB)</option>
                        <option value="Gudang Komersial & Pusat Distribusi">Gudang Komersial & Pusat Distribusi</option>
                        <option value="Fasilitas KLIK (BKPM) & Perizinan">Fasilitas KLIK (BKPM) & Perizinan</option>
                        <option value="Jadwal Survei Lapangan Langsung">Jadwal Survei Lapangan Langsung</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-700 mb-1">Catatan Tambahan / Luas yang Dibutuhkan</label>
                    <textarea x-model="form.message" rows="2" placeholder="Tuliskan estimasi luas lahan atau kebutuhan daya listrik industri Anda..."
                              class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2 text-slate-800 focus:outline-none focus:border-amber-600 focus:bg-white transition-all text-xs"></textarea>
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="w-full py-3 px-4 rounded-xl bg-amber-700 hover:bg-amber-800 text-white font-bold text-xs transition-all shadow-md active:scale-[0.98] flex items-center justify-center gap-2 cursor-pointer">
                        <i data-lucide="send" class="w-4 h-4"></i>
                        <span>Kirim Permintaan ke WhatsApp Official</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- DETAIL MODAL (Spesifikasi Unit & Informasi Fasilitas) -->
    <div x-show="detailModalOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-xs"
         style="display: none;"
         @keydown.escape.window="detailModalOpen = false">

        <div @click.outside="detailModalOpen = false"
             class="w-full max-w-md bg-white border border-slate-200 text-slate-800 rounded-2xl shadow-2xl p-5 sm:p-6 relative max-h-[90dvh] overflow-y-auto">
            
            <button @click="detailModalOpen = false" class="absolute top-4 right-4 p-1.5 rounded-lg text-slate-400 hover:text-slate-700 hover:bg-slate-100 transition-colors">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>

            <div class="text-left">
                <div class="flex items-center gap-2 mb-2">
                    <span class="inline-block px-2 py-0.5 rounded-md text-[10px] font-bold bg-amber-100 text-amber-800 font-mono" x-text="activeDetail.badge || 'Spesifikasi'"></span>
                    <span class="text-[10px] text-slate-400 font-semibold tracking-wider uppercase">KIW COMMERCIAL ESTATE</span>
                </div>
                <h3 class="font-display text-lg font-bold text-slate-900 leading-tight" x-text="activeDetail.title"></h3>
                <p class="text-xs text-slate-500 mt-1 font-medium" x-text="activeDetail.subtitle"></p>

                <div class="mt-4 pt-4 border-t border-slate-100 text-xs text-slate-600 leading-relaxed space-y-3" x-html="activeDetail.content"></div>

                <div class="mt-6 flex items-center gap-2">
                    <button @click="detailModalOpen = false; openInquiry(activeDetail.title)"
                            class="flex-1 py-2.5 px-3 rounded-xl bg-amber-700 hover:bg-amber-800 text-white font-semibold text-xs transition-colors flex items-center justify-center gap-1.5 cursor-pointer">
                        <i data-lucide="calendar" class="w-3.5 h-3.5"></i>
                        <span>Jadwalkan Survei</span>
                    </button>
                    <a :href="'https://wa.me/{{ $settings['whatsapp'] ?? '628112345678' }}?text=Halo%20Marketing%20KIW,%20saya%20ingin%20tanya%20detail%20mengenai%20' + encodeURIComponent(activeDetail.title)"
                       target="_blank"
                       class="py-2.5 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs transition-colors flex items-center justify-center gap-1.5">
                        <i data-lucide="message-square" class="w-3.5 h-3.5"></i>
                        <span>WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- TOAST NOTIFICATION -->
    <div x-show="toast.show"
         x-transition:enter="transition ease-out duration-250"
         x-transition:enter-start="opacity-0 translate-y-3 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-3 scale-95"
         class="fixed bottom-6 z-50 px-4 py-2.5 rounded-full bg-slate-900/95 text-white text-xs font-semibold shadow-2xl flex items-center gap-2 border border-slate-700/80"
         style="display: none;">
        <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400"></i>
        <span x-text="toast.message"></span>
    </div>

</body>
</html>
