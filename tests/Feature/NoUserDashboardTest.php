<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoUserDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_after_login_redirects_to_home_not_dashboard(): void
    {
        $user = User::factory()->create(['email_verified_at' => now()]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('home', absolute: false));
    }

    public function test_user_dashboard_route_does_not_exist(): void
    {
        $this->assertFalse(app('router')->getRoutes()->hasNamedRoute('dashboard'));
    }

    public function test_home_still_shows_daftar_button_for_guest_and_keluar_for_user(): void
    {
        $response = $this->get('/');
        $response->assertOk();
        $response->assertSee('Daftar');
        $response->assertDontSee('>Dashboard</a>');
    }
}