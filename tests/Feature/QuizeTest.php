<?php

namespace Tests\Feature;

use App\Models\Quize;
use App\Models\QuizeGroup;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuizeTest extends TestCase
{
    use RefreshDatabase;

    // レンダリング(クイズ作成)
    public function test_questions_create_can_be_rendered()
    {
        $quize_group = QuizeGroup::factory()->create();
        $user = User::find($quize_group->user_id);
        $response = $this->actingAs($user)->get('/quize/create/' . $quize_group->id);
        $response->assertStatus(200);
    }
    public function test_questions_create_no_content_404_can_be_returned()
    {
        $quize_group = QuizeGroup::factory()->create();
        $user = User::find($quize_group->user_id);
        $response = $this->actingAs($user)->get('/quize/create/' . $quize_group->id + 10000);
        $response->assertStatus(404);
    }
    public function test_questions_create_has_content_1_can_be_redirected()
    {
        $quize_group = QuizeGroup::factory()->create(['has_content' => 1]);
        $user = User::find($quize_group->user_id);
        $response = $this->actingAs($user)->get('/quize/create/' . $quize_group->id);
        $response->assertRedirect('/quize_group/menu');
    }
    public function test_questions_create_unauthenticated_can_be_redirected()
    {
        $quize_group = QuizeGroup::factory()->create();
        $response = $this->get('/quize/create/' . $quize_group->id);
        $response->assertRedirect('/login');
    }
    public function test_questions_edit_can_be_rendered()
    {
        $quize_group = QuizeGroup::factory()->create();
        $user = User::find($quize_group->user_id);
        $response = $this->actingAs($user)->get('/quize/edit/' . $quize_group->id);
        $response->assertStatus(200);
    }
    public function test_questions_edit_no_content_404_can_be_returned()
    {
        $quize_group = QuizeGroup::factory()->create();
        $user = User::find($quize_group->user_id);
        $response = $this->actingAs($user)->get('/quize/edit/' . $quize_group->id + 1);
        $response->assertStatus(404);
    }
    public function test_questions_edit_unauthenticated_can_be_redirected()
    {
        $quize_group = QuizeGroup::factory()->create();
        $response = $this->get('/quize/edit/' . $quize_group->id);
        $response->assertRedirect('/login');
    }
    // レンダリング(クイズ一覧)
    public function test_questions_can_be_rendered()
    {
        $quize_length = Quize::where('quize_group_id', 1)->count();
        for ($i = 1; $i <= $quize_length; $i++) {
            $response = $this->get('quize/1/' . $i);
            $response->assertStatus(200);

            if ($quize_length !== $i) {
                $response->assertSee('次へ');
            } else {
                $response->assertSee('結果発表');
            }
        }
    }
    // CUD処理
    public function test_quize_store_can_be_excuted()
    {
        $quize_group = QuizeGroup::factory()->create();
        $quize_data = Quize::factory(['quize_group_id' => $quize_group->id])->make();
        $user = User::find($quize_group->user_id);
        $quizes_array = [$quize_data, [$quize_group->id]];
        $response = $this->actingAs($user)->postJson('/quize/store', $quizes_array);

        $this->assertDatabaseHas('quizes', $quize_data->toArray());
        $response->assertStatus(200);
    }
    public function test_quize_store_unauthenticated_401_can_be_returned()
    {
        $quize_group = QuizeGroup::factory()->create();
        $quize_data = Quize::factory(['quize_group_id' => $quize_group->id])->make();
        $quizes_array = [$quize_data, [$quize_group->id]];
        $response = $this->postJson('/quize/store', $quizes_array);
        $this->assertDatabaseMissing('quizes', $quize_data->toArray());
        $response->assertStatus(401);
    }
    public function test_quize_store_no_content_404_can_be_returned()
    {
        $quize_group = QuizeGroup::factory()->create();
        $quize_data = Quize::factory(['quize_group_id' => $quize_group->id])->make();
        $user = User::find($quize_group->user_id);
        $quizes_array = [$quize_data, [$quize_group->id + 10000]];
        $response = $this->actingAs($user)->postJson('/quize/store', $quizes_array);

        $this->assertDatabaseMissing('quizes', $quize_data->toArray());
        $response->assertStatus(404);
    }
    public function test_quize_update_can_be_excuted_and_redirect()
    {
        $quize_group = QuizeGroup::factory(['has_content' => 1])->create();
        $quize_data = Quize::factory(['quize_group_id' => $quize_group->id])->create();
        $user = User::find($quize_group->user_id);
        $updated_quize_data = Quize::factory()->make()->toArray();
        $updated_quize_array = [$updated_quize_data, [$quize_group->id]];
        $response = $this->actingAs($user)->postJson('/quize/update', $updated_quize_array);
        $this->assertDatabaseMissing('quizes', $quize_data->toArray());
        $this->assertDatabaseHas('quizes', $updated_quize_data);
        $response->assertStatus(200);
    }
    public function test_quize_update_unauthenticated_401_can_be_returned()
    {
        $quize_group = QuizeGroup::factory(['has_content' => 1])->create();
        $quize_data = Quize::factory(['quize_group_id' => $quize_group->id])->create();
        $updated_quize_data = Quize::factory()->make()->toArray();
        $updated_quize_array = [$updated_quize_data, [$quize_group->id]];
        $response = $this->postJson('/quize/update', $updated_quize_array);
        $this->assertDatabaseHas('quizes', $quize_data->toArray());
        $this->assertDatabaseMissing('quizes', $updated_quize_data);
        $response->assertStatus(401);
    }
    public function test_quize_update_404_can_be_returned()
    {
        $quize_group = QuizeGroup::factory(['has_content' => 1])->create();
        $quize_data = Quize::factory(['quize_group_id' => $quize_group->id])->create();
        $user = User::find($quize_group->user_id);
        $updated_quize_data = Quize::factory()->make()->toArray();
        $updated_quize_array = [$updated_quize_data, [$quize_group->id + 10000]];
        $response = $this->actingAs($user)->postJson('/quize/update', $updated_quize_array);
        $this->assertDatabaseHas('quizes', $quize_data->toArray());
        $this->assertDatabaseMissing('quizes', $updated_quize_data);
        $response->assertStatus(404);
    }
}
