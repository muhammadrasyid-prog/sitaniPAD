<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page_accessible()
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
    }

    public function test_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/admin/login', [
            'email' => 'admin@test.com',
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($user);
    }

    public function test_login_with_invalid_credentials()
    {
        $response = $this->post('/admin/login', [
            'email' => 'nonexistent@test.com',
            'password' => 'wrongpassword',
        ]);

        $this->assertGuest();
    }

    public function test_guest_redirected_to_login_when_accessing_admin()
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/admin/login');
    }

    public function test_authenticated_user_can_access_admin_dashboard()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(200);
    }

    public function test_logout_functionality()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        
        $response = $this->post('/admin/logout');
        $this->assertGuest();
    }
}
