<?php

namespace Tests\Feature;

use App\Models\EmailVerification;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_email_verification_notification_screen_can_be_rendered()
    {
        $response = $this->get('/verify_email/notification');
        $response->assertStatus(200);
    }
    public function test_email_verification_invalid_token_screen_can_be_rendered()
    {
        $response = $this->get('/verify_email/invalid_token');
        $response->assertStatus(200);
    }
    public function test_email_can_be_verified()
    {
        $temporary_user = EmailVerification::factory(['expiration_datetime' => now()])->create();
        $response = $this->get('/verify_email/verify/' . $temporary_user->id . '/' . $temporary_user->token);
        $this->assertDatabaseHas('users', ['name' => $temporary_user->name, 'email' => $temporary_user->email, 'password' => $temporary_user->password]);
        $user = User::where('email', $temporary_user->email)->first();
        $response->assertRedirect('/user/' . $user->id);
        $this->assertAuthenticated();
    }
    public function test_email_is_invalid_hash()
    {
        // 期限切れ
        $temporary_user = EmailVerification::factory(['expiration_datetime' => now()->subDay(1)])->create();

        $response = $this->get('/verify_email/verify/' . $temporary_user->id . '/' . $temporary_user->token);
        $this->assertDatabaseMissing('users', ['name' => $temporary_user->name, 'email' => $temporary_user->email, 'password' => $temporary_user->password]);
        $response->assertRedirect('/verify_email/invalid_token');
        $this->assertGuest();
    }
    public function test_user_already_exists_redirected()
    {
        $temporary_user = EmailVerification::factory()->create();
        User::factory([
            'name' => $temporary_user->name,
            'email' => $temporary_user->email,
            'password' => $temporary_user->password,
        ])->create();

        $response = $this->get('/verify_email/verify/' . $temporary_user->id . '/' . $temporary_user->token);
        $response->assertRedirect('/verify_email/invalid_token');
        $this->assertGuest();
    }
}
