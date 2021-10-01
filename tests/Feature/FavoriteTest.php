<?php

namespace Tests\Feature;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoriteTest extends TestCase
{

    use RefreshDatabase;

    // リダイレクト
    public function test_favorite_screen_can_be_rendered_when_saved_as_bookmark()
    {
        // お気に入り登録後
        $user = User::factory()->create();
        Favorite::create([
            'user_id' => $user->id,
            'quize_group_id' => 1,
        ]);

        $response = $this->actingAs($user)->get('/favorite');

        $response->assertSee('ユーザー');
        $response->assertSee('タイトル');
        $response->assertSee('カテゴリ');

        $response->assertStatus(200);
    }
    public function test_favorite_screen_can_be_rendered()
    {
        // お気に入り登録前
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/favorite');

        $response->assertSee('クイズ集がお気に入りに登録されていません。');

        $response->assertStatus(200);
    }
    public function test_favorite_unauthenticated_screen_can_be_rendered()
    {
        $response = $this->get('/favorite');
        $response->assertStatus(200);
        $response->assertSee('ログインしていません。');
    }
    // CRUD処理
}
