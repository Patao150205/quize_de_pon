<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_user_can_be_rendered()
    {
        $user = User::factory()->create();
        $response = $this->get('/user/' . $user->id);
        $response->assertSee($user->name);
        $response->assertSee(['タイトル', 'カテゴリ', 'いいね']);
        $response->assertDontSee('プロフィール編集');
        $response->assertStatus(200);
    }
    public function test_user_own_can_be_rendered()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/user/' . $user->id);
        $response->assertSee($user->name);
        $response->assertSee(['タイトル', 'カテゴリ', 'いいね']);
        $response->assertSee('プロフィール編集');
        $response->assertStatus(200);
    }
    public function test_user_edit_can_be_rendered()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/user/edit');
        $response->assertSee($user->name);
        $response->assertSee($user->profile);

        $response->assertStatus(200);
    }
    public function test_user_edit_unauthenticated_can_be_redirected()
    {
        $response = $this->get('/user/edit');
        $response->assertRedirect('/login');
    }
    public function test_user_update_can_be_excuted()
    {
        $user = User::factory()->create();
        $updated_user = User::factory(['id' => $user->id, 'email' => $user->email])->make();
        $response = $this->actingAs($user)->post('/user/update', $updated_user->toArray());
        $this->assertDatabaseMissing('users', $user->toArray());
        $this->assertDatabaseHas('users', ['id' => $updated_user->id, 'name' => $updated_user->name, 'profile' => $updated_user->profile]);
        $response->assertRedirect('/user/' . $user->id);
    }
    public function test_user_update_unauthenticated_can_be_redirected()
    {
        $response = $this->get('/user/edit');
        $response->assertRedirect('/login');
    }
}
