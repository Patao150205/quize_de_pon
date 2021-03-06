<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_temporary_user_can_register()
    {
        $token = uniqid('', true);
        $sendData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => $token
        ];
        $emailVerificationData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ];
        $response = $this->post('/register', $sendData);
        $response->assertRedirect('/verify_email/notification');
        $this->assertDatabaseHas('email_verifications', $emailVerificationData);
    }
}
