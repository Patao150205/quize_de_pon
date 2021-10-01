<?php

namespace Tests\Feature;

use App\Models\QuizeGroup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class QuizeGroupTest extends TestCase
{
    use RefreshDatabase;

    public function create_quize_group_record($user_id, $has_contet = 0)
    {
        $quize_group = QuizeGroup::create([
            'title' => 'ダミー',
            'information' => 'ダミーの問題',
            'has_content' => $has_contet,
            'user_id' => $user_id,
            'category_id' => 1,
        ]);
        return $quize_group;
    }
    // レンダリング
    public function test_create_quize_menu_can_be_rendered()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/quize_group/menu');
        $response->assertSee('クイズ集＆問題の新規作成');
        $response->assertSee('クイズ集＆問題の編集');
        $response->assertStatus(200);
    }
    public function test_create_quize_menu_unauthenticated_screen_can_be_rendered()
    {
        $response = $this->get('/quize_group/menu');
        $response->assertSee('ログインしていません。');
        $response->assertStatus(200);
    }
    public function test_group_create_screen_can_be_rendered()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/quize_group/create');
        $response->assertStatus(200);
    }
    public function test_quize_edit_list_can_be_rendered()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/quize_group/edit_list');
        $response->assertStatus(200);
        $response->assertSee('タイトル');
        $response->assertSee('カテゴリ');
        $response->assertSee('削除');
    }
    public function test_quize_group_edit_can_be_rendered()
    {
        $user = User::factory()->create();
        $quize_group = $this->create_quize_group_record($user->id);
        $response = $this->actingAs($user)->get('/quize_group/edit/' . $quize_group->id);
        $response->assertSee($quize_group->title);
        $response->assertSee($quize_group->information);
        $response->assertStatus(200);
    }
    // リダイレクト
    public function test_group_create_unauthenticated_can_be_redirected()
    {
        $response = $this->get('/quize_group/create');
        $response->assertRedirect('/login');
    }
    public function test_quize_edit_list_unauthenticated_can_be_redirected()
    {
        $response = $this->get('/quize_group/edit_list');
        $response->assertRedirect('/login');
    }
    public function test_quize_group_edit_unauthenticated_can_be_rendirected()
    {
        $user = User::factory()->create();
        $quize_group = $this->create_quize_group_record($user->id);
        $response = $this->get('/quize_group/edit/' . $quize_group->id);
        $response->assertRedirect('/login');
    }
    // CUD処理
    public function test_quize_group_store_can_be_excuted_and_redirect()
    {
        $user = User::factory()->create();
        $data = [
            'title' => 'ダミー',
            'information' => 'ダミーの問題',
            'user_id' => $user->id,
            'category_id' => 1,
        ];
        $response = $this->actingAs($user)->post('/quize_group/store', $data);
        $this->assertDatabaseHas('quize_groups', $data);

        $response->assertStatus(302);
    }
    public function test_quize_group_store_unauthenticated_can_be_redirect()
    {
        $user = User::factory()->create();
        $data = [
            'title' => 'ダミー',
            'information' => 'ダミーの問題',
            'user_id' => $user->id,
            'category_id' => 1,
        ];
        $response = $this->post('/quize_group/store', $data);
        $this->assertDatabaseMissing('quize_groups', $data);
        $response->assertRedirect('/login');
    }
    public function test_quize_group_update_can_be_excuted_and_redirect()
    {
        $user = User::factory()->create();
        $updated_data = [
            'title' => 'ダミー更新',
            'information' => 'ダミーの問題更新',
            'user_id' => $user->id,
            'category_id' => 1,
        ];
        $quize_group = $this->create_quize_group_record($user->id);
        $response = $this->actingAs($user)->post('/quize_group/edit/update/' . $quize_group->id, $updated_data);
        $this->assertDatabaseHas('quize_groups', $updated_data);
        $response->assertRedirect('/quize/edit/' . $quize_group->id);
    }
    public function test_quize_group_update_unauthenticated_can_be_redirect()
    {
        $user = User::factory()->create();
        $data = [
            'title' => 'ダミー',
            'information' => 'ダミーの問題',
            'user_id' => $user->id,
            'category_id' => 1,
        ];
        $response = $this->post('/quize_group/store', $data);
        $this->assertDatabaseMissing('quize_groups', $data);
        $response->assertRedirect('/login');
    }
    public function test_quize_group_delete_can_be_execute()
    {
        $user = User::factory()->create();
        $quize_group = $this->create_quize_group_record($user->id);
        $response = $this->actingAs($user)->post('/quize_group/destroy/' . $quize_group->id);
        $this->assertDatabaseMissing('quize_groups', [
            'id' => $quize_group->id
        ]);
    }
    public function test_quize_group_delete_unauthenticated_can_not_be_execute()
    {
        $user = User::factory()->create();
        $quize_group = $this->create_quize_group_record($user->id);
        $response = $this->post('/quize_group/destroy/' . $quize_group->id);
        $this->assertDatabaseHas('quize_groups', [
            'id' => $quize_group->id
        ]);
        $response->assertRedirect('/login');
    }
}
