<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Hash;

class AuditVerificationTest extends TestCase
{
    public function test_public_pages_return_successful_response(): void
    {
        $this->get('/')->assertStatus(200);
        $this->get('/paket-wisata')->assertStatus(200);
        $this->get('/destinasi')->assertStatus(200);
        $this->get('/about')->assertStatus(200);
    }

    public function test_contact_form_submission_stores_data(): void
    {
        $response = $this->post('/contact', [
            'name'    => 'Test User Audit',
            'phone'   => '081234567890',
            'email'   => 'audit_test@example.com',
            'message' => 'Pesan pengujian audit sistem.',
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contacts', [
            'email' => 'audit_test@example.com',
        ]);

        // Cleanup
        Contact::where('email', 'audit_test@example.com')->delete();
    }

    public function test_guest_cannot_access_profile(): void
    {
        $response = $this->get('/profile');
        $response->assertRedirect('/login');
    }

    public function test_register_creates_new_user(): void
    {
        $email = 'new_registered_user_' . time() . '@example.com';

        $response = $this->post('/register', [
            'name'                  => 'New User',
            'email'                 => $email,
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('users', ['email' => $email]);

        // Cleanup
        User::where('email', $email)->delete();
    }

    public function test_login_validation_and_authentication(): void
    {
        // 1. Wrong password fails
        $response = $this->post('/login', [
            'email'    => 'admin@gmail.com',
            'password' => 'wrongpassword',
        ]);
        $response->assertSessionHas('error');

        // 2. Correct password logs in and redirects admin to /admin
        $response = $this->post('/login', [
            'email'    => 'admin@gmail.com',
            'password' => 'admin123',
        ]);
        $response->assertRedirect('/admin');
        $response->assertSessionHas('user');
    }

    public function test_admin_dashboard_protection(): void
    {
        // Guest is redirected to login
        $this->get('/admin')->assertRedirect('/login');

        // Standard user is denied access to admin
        $normalUser = User::where('role', 'user')->first();
        if ($normalUser) {
            $this->actingAs($normalUser)
                 ->withSession(['user' => ['id' => $normalUser->id, 'role' => 'user']])
                 ->get('/admin')
                 ->assertRedirect('/profile');
        }
    }
}
