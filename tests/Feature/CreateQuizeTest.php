<?php

namespace Tests\Feature;

use App\Models\QuizeGroup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateQuizeTest extends TestCase
{
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
    public function test_quize_create_screen_can_be_rendered()
    {
        $user = User::factory()->create();
        $quize_group = $this->create_quize_group_record($user->id);
        $response = $this->actingAs($user)->get('/quize/create/' . $quize_group->id);
        $response->assertStatus(200);
    }
    public function test_quize_create_not_own_quize_can_be_returned_404()
    {
        $user = User::factory()->create();
        $quize_group = $this->create_quize_group_record($user->id);
        $response = $this->actingAs($user)->get('/quize/create/' . $quize_group->id - 1);
        $response->assertStatus(404);
    }
    public function test_quize_edit_can_be_rendered()
    {
        $user = User::factory()->create();
        $quize_group = $this->create_quize_group_record($user->id);
        $response = $this->actingAs($user)->get('/quize/edit/' . $quize_group->id);
        $response->assertSee($quize_group->title);
        $response->assertStatus(200);
    }
    public function test_quize_delete_can_be_execute()
    {
        $user = User::factory()->create();
        $quize_group = $this->create_quize_group_record($user->id);
        $response = $this->actingAs($user)->post('/quize_group/destroy/' . $quize_group->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('quize_groups', [
            'id' => $quize_group->id
        ]);
    }
    // リダイレクト
    public function test_quize_create_has_content_1_can_be_redirected()
    {
        $user = User::factory()->create();
        $quize_group = $this->create_quize_group_record($user->id, 1);
        $response = $this->actingAs($user)->get('/quize/create/' . $quize_group->id);
        $response->assertStatus(302);
    }
    public function test_quize_create_unauthenticated_can_be_redirected()
    {
        $response = $this->get('/quize/create/1');
        $response->assertStatus(302);
    }
    public function test_quize_edit_can_be_redirected()
    {
        $response = $this->get('/quize/edit/1');
        $response->assertStatus(302);
    }
    // CRUD処理

}
