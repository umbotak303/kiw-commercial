<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use App\Models\Slide;
use App\Models\SlideItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class KiwCommercialSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Settings
        $settings = [
            'name' => 'PT Kawasan Industri Wijayakusuma',
            'short' => 'KIW COMMERCIAL',
            'tagline' => 'Integrated & Sustainable Industrial Estate',
            'phone' => '+62 24 8662156',
            'whatsapp' => '628112345678',
            'whatsapp_display' => '+62 811-2345-678',
            'email' => 'marketing@kiw.co.id',
            'address' => 'Jl. Raya Semarang - Kendal Km. 12, Semarang 50153, Jawa Tengah',
            'maps_url' => 'https://maps.google.com/?q=PT+Kawasan+Industri+Wijayakusuma',
            'website' => 'https://www.kiw.co.id',
            'logo' => 'assets/logo kiw.png',
            'footer_badge' => 'KIW COMMERCIAL • INDUSTRIAL ESTATE',
            'theme_style' => 'corporate_navy',
            'theme_primary' => '#0ea5e9',
            'theme_bg' => '#0b1120',
            'theme_card_bg' => '#0f172a',
            'theme_card_text' => '#f1f5f9',
            'theme_card_border' => '#1e293b',
        ];

        foreach ($settings as $key => $val) {
            SiteSetting::set($key, $val);
        }

        // Reset existing slides to avoid duplicates during reseed
        // Disable foreign key constraints to prevent truncate error on MySQL
        Schema::disableForeignKeyConstraints();
        SlideItem::truncate();
        Slide::truncate();
        Schema::enableForeignKeyConstraints();

        // 2. Halaman 1: WEBSITE & PROFIL PT KIW
        $slide1 = Slide::create([
            'title' => 'WEBSITE & PROFIL',
            'subtitle' => 'Informasi Resmi Perseroan',
            'banner_image' => null,
            'banner_text' => 'PT KAWASAN INDUSTRI WIJAYAKUSUMA • Kawasan industri terintegrasi dan ramah lingkungan di Jawa Tengah',
            'nav_label' => 'Website & Profil',
            'icon' => 'globe',
            'order' => 1,
            'is_active' => true,
        ]);

        $slide1Items = [
            [
                'title' => 'Website Resmi PT KIW',
                'url' => 'https://www.kiw.co.id',
                'action_type' => 'link',
                'icon' => 'globe',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Profil & Tentang Perusahaan',
                'url' => 'https://www.kiw.co.id/tentang-kami',
                'action_type' => 'link',
                'icon' => 'building-2',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Produk & Kawasan Industri',
                'url' => 'https://www.kiw.co.id/fasilitas',
                'action_type' => 'link',
                'icon' => 'factory',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Berita & Pengumuman Terbaru',
                'url' => 'https://www.kiw.co.id/berita',
                'action_type' => 'link',
                'icon' => 'newspaper',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($slide1Items as $item) {
            $slide1->items()->create($item);
        }

        // 3. Halaman 2: KONTAK PERSON & MEDIA SOSIAL RESMI
        $slide2 = Slide::create([
            'title' => 'KONTAK & MEDIA SOSIAL',
            'subtitle' => 'Hubungi & Terhubung dengan Kami',
            'banner_image' => null,
            'banner_text' => 'HUBUNGI KAMI • Layanan WhatsApp Marketing, Telepon, dan Akun Media Sosial Resmi',
            'nav_label' => 'Kontak & Sosmed',
            'icon' => 'message-circle',
            'order' => 2,
            'is_active' => true,
        ]);

        $slide2Items = [
            [
                'title' => 'WhatsApp Contact Person',
                'url' => 'https://wa.me/628112345678?text=Halo%20KIW,%20saya%20ingin%20konsultasi%20mengenai%20Kawasan%20Industri%20Wijayakusuma.',
                'action_type' => 'whatsapp',
                'icon' => 'message-square',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Instagram Resmi @kiw_industrial',
                'url' => 'https://www.instagram.com/kiw_industrial/',
                'action_type' => 'link',
                'icon' => 'instagram',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'LinkedIn PT Kawasan Industri Wijayakusuma',
                'url' => 'https://www.linkedin.com/company/pt-kawasan-industri-wijayakusuma/',
                'action_type' => 'link',
                'icon' => 'linkedin',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Telepon Kantor (024) 8662156',
                'url' => 'tel:+62248662156',
                'action_type' => 'call',
                'icon' => 'phone',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Petunjuk Arah Google Maps',
                'url' => 'https://maps.google.com/?q=PT+Kawasan+Industri+Wijayakusuma',
                'action_type' => 'map',
                'icon' => 'map-pin',
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($slide2Items as $item) {
            $slide2->items()->create($item);
        }
    }
}
