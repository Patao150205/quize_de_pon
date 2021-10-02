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
        // お気に入り登録後
        $favorite = Favorite::factory()->create();
        $user = User::find($favorite->user_id);

        $response = $this->actingAs($user)->get('/favorite');

        $info = DB::table('favorites')
            ->select(DB::raw('title, users.name, name_jp'))
            ->join('quize_groups', 'quize_groups.id', '=', 'favorites.quize_group_id')
            ->join('categories', 'categories.id', '=', 'quize_groups.category_id')
            ->join('users', 'users.id', '=', 'quize_groups.user_id')
            ->where('favorites.user_id', $user->id)
            ->first();

        $response->assertSee($info->name);
        $response->assertSee($info->title);
        $response->assertSee($info->name_jp);

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
