<?php

namespace Tests\Feature;

use App\Models\SiteSetting;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        if (!User::where('email', 'admin@kiw.co.id')->exists()) {
            User::factory()->create([
                'name' => 'Administrator KIW',
                'email' => 'admin@kiw.co.id',
                'password' => bcrypt('admin123'),
            ]);
        }
    }

    public function test_admin_can_view_login_page(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
        $response->assertSee('KIW COMMERCIAL');
        $response->assertSee('Masuk Administrator');
    }

    public function test_admin_can_login_with_credentials(): void
    {
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'email' => 'admin@kiw.co.id',
                'password' => bcrypt('admin123'),
            ]);
        }

        $response = $this->post('/login', [
            'email' => 'admin@kiw.co.id',
            'password' => 'admin123',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_can_access_dashboard_and_settings(): void
    {
        $user = User::first();
        $this->actingAs($user);

        $response = $this->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Atur Kartu');
        $response->assertSee('Atur Tema & Warna', false);

        $settingsResponse = $this->get('/admin/settings');
        $settingsResponse->assertStatus(200);
        $settingsResponse->assertSee('Pilihan Preset Tema');
        $settingsResponse->assertSee('Kustomisasi Skema Warna');
        $settingsResponse->assertSee('Pengaturan Gaya Kartu');
    }

    public function test_admin_can_update_theme_card_and_colors(): void
    {
        $user = User::first();
        $this->actingAs($user);

        $payload = [
            'name' => 'PT Kawasan Industri Wijayakusuma',
            'short' => 'KIW COMMERCIAL',
            'tagline' => 'Integrated & Sustainable Industrial Estate',
            'whatsapp' => '628112345678',
            'whatsapp_display' => '+62 811-2345-678',
            'phone' => '+62 24 8662156',
            'email' => 'marketing@kiw.co.id',
            'address' => 'Semarang, Jawa Tengah',
            'website' => 'https://www.kiw.co.id',
            'footer_badge' => 'KIW COMMERCIAL TEST',

            'theme_style' => 'corporate_navy',
            'theme_primary' => '#0ea5e9',
            'theme_bg' => '#0b1120',
            'theme_card_bg' => '#0f172a',
            'theme_card_text' => '#f1f5f9',
            'theme_card_border' => '#1e293b',
            'theme_card_radius' => 'rounded-[28px]',
            'theme_button_bg' => '#1e293b',
            'theme_button_text' => '#f8fafc',
            'theme_button_border' => '#334155',
        ];

        $response = $this->post('/admin/settings', $payload);
        $response->assertRedirect('/admin/settings');
        $response->assertSessionHas('success');

        $this->assertEquals('corporate_navy', SiteSetting::get('theme_style'));
        $this->assertEquals('#0ea5e9', SiteSetting::get('theme_primary'));
        $this->assertEquals('#0f172a', SiteSetting::get('theme_card_bg'));
        $this->assertEquals('PT Kawasan Industri Wijayakusuma', SiteSetting::get('name'));
        $this->assertEquals('KIW COMMERCIAL', SiteSetting::get('short'));
        $this->assertEquals('628112345678', SiteSetting::get('whatsapp'));
        $this->assertEquals('+62 811-2345-678', SiteSetting::get('whatsapp_display'));
        $this->assertEquals('+62 24 8662156', SiteSetting::get('phone'));
        $this->assertEquals('marketing@kiw.co.id', SiteSetting::get('email'));
        $this->assertEquals('https://www.kiw.co.id', SiteSetting::get('website'));
        $this->assertEquals('KIW COMMERCIAL TEST', SiteSetting::get('footer_badge'));
        $this->assertEquals('Integrated & Sustainable Industrial Estate', SiteSetting::get('tagline'));
        $this->assertEquals('Semarang, Jawa Tengah', SiteSetting::get('address'));
    }

    public function test_admin_can_create_and_manage_cards(): void
    {
        $user = User::first();
        $this->actingAs($user);

        $cardData = [
            'title' => 'KARTU LAYANAN BARU',
            'subtitle' => 'Penjelasan Subtitle Kartu',
            'nav_label' => 'Layanan Baru',
            'order' => 99,
            'is_active' => 1,
        ];

        $response = $this->post('/admin/slides', $cardData);
        $response->assertRedirect('/admin/slides');

        $card = Slide::where('title', 'KARTU LAYANAN BARU')->first();
        $this->assertNotNull($card);

        // Edit Card
        $updateResponse = $this->put('/admin/slides/' . $card->id, [
            'title' => 'KARTU LAYANAN DIPERBARUI',
            'subtitle' => 'Subtitle baru',
            'nav_label' => 'Update Label',
            'order' => 99,
            'is_active' => 1,
        ]);
        $updateResponse->assertRedirect('/admin/slides');

        $card->refresh();
        $this->assertEquals('KARTU LAYANAN DIPERBARUI', $card->title);

        // Delete Card
        $deleteResponse = $this->delete('/admin/slides/' . $card->id);
        $deleteResponse->assertRedirect('/admin/slides');
        $this->assertNull(Slide::find($card->id));
    }

    public function test_admin_can_seed_defaults(): void
    {
        $user = User::first();
        $this->actingAs($user);

        $response = $this->post(route('admin.seed.defaults'));
        $response->assertRedirect('/admin');
        $response->assertSessionHas('success');

        $this->assertGreaterThan(0, Slide::count());
    }
}
