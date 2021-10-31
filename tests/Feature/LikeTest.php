<?php

namespace Tests\Feature;

use App\Models\Favorite;
use App\Models\QuizeGroup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    // リダイレクト
    public function test_favorite_screen_can_be_rendered()
    {
        // お気に入り登録後
        $user = User::factory()->create();
        Favorite::create([
            'user_id' => $user->id,
            'quize_group_id' => 1,
        ]);

        $response = $this->actingAs($user)->get('/favorite');
        $quize_group = QuizeGroup::where('id', 1)->first();

        $response->assertSee('タイトル');
        $response->assertSee('カテゴリ');
        $response->assertSee($quize_group->title);

        $response->assertStatus(200);
    }
    public function test_favorite_screen_no_content_can_be_rendered()
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
    public function test_favorite_regist_can_be_excuted()
    {
        $user = User::factory()->create();
        $quize_group = QuizeGroup::factory()->create();
        $response = $this->actingAs($user)->post('/favorite/' . $quize_group->id . '/' . $user->id);
        $this->assertDatabaseHas('favorites', ['user_id' => $user->id, 'quize_group_id' => $quize_group->id]);
        $response->assertStatus(200);
    }
    public function test_toggle_favorite_can_be_excuted()
    {
        // 登録
        $user = User::factory()->create();
        $quize_group = QuizeGroup::factory()->create();
        $response1 = $this->actingAs($user)->post('/favorite/' . $quize_group->id . '/' . $user->id);
        $this->assertDatabaseHas('favorites', ['user_id' => $user->id, 'quize_group_id' => $quize_group->id]);
        $response1->assertStatus(200);
        // 解除
        $response2 = $this->actingAs($user)->post('/favorite/' . $quize_group->id . '/' . $user->id);
        $this->assertDatabaseMissing('favorites', ['user_id' => $user->id, 'quize_group_id' => $quize_group->id]);
        $response2->assertStatus(200);
    }
    public function test_toggle_good_can_be_excuted()
    {
        // 登録
        $user = User::factory()->create();
        $quize_group = QuizeGroup::factory()->create();
        $response1 = $this->actingAs($user)->post('/good/' . $quize_group->id . '/' . $user->id);
        $this->assertDatabaseHas('goods', ['user_id' => $user->id, 'quize_group_id' => $quize_group->id]);
        $response1->assertStatus(200);
        // 解除
        $response2 = $this->actingAs($user)->post('/good/' . $quize_group->id . '/' . $user->id);
        $this->assertDatabaseMissing('goods', ['user_id' => $user->id, 'quize_group_id' => $quize_group->id]);
        $response2->assertStatus(200);
    }
}
