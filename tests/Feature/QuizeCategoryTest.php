<?php

namespace Tests\Feature;

use App\Models\Category;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class QuizeCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function table_data_render($response)
    {
        $response->assertSee('ユーザー');
        $response->assertSee('タイトル');
        $response->assertSee('いいね');
    }

    public function test_quize_category_list_screen_can_be_rendered()
    {
        $response = $this->get('/category');
        $response->assertStatus(200);
    }
    public function test_quize_category_all_screen_can_be_rendered()
    {
        $response = $this->get('/category/all');
        $response->assertStatus(200);
        $response->assertSee('すべて');
        $this->table_data_render($response);
    }
    public function test_quize_category_anime_game_screen_can_be_rendered()
    {
        $response = $this->get('/category/anime_game');
        $this->assertDatabaseHas('categories', [
            'name' => 'anime_game'
        ]);
        $response->assertStatus(200);
        $response->assertSee('アニメ＆ゲーム');
        $this->table_data_render($response);
    }
    public function test_quize_category_sports_screen_can_be_rendered()
    {
        $response = $this->get('/category/sports');
        $this->assertDatabaseHas('categories', [
            'name' => 'sports'
        ]);
        $response->assertStatus(200);
        $response->assertSee('スポーツ');
        $this->table_data_render($response);
    }
    public function test_quize_category_entertainment_screen_can_be_rendered()
    {
        $response = $this->get('/category/entertainment');
        $this->assertDatabaseHas('categories', [
            'name' => 'entertainment'
        ]);
        $response->assertStatus(200);
        $response->assertSee('芸能');
        $this->table_data_render($response);
    }
    public function test_quize_category__screen_can_be_rendered()
    {
        $response = $this->get('/category/trivia');
        $this->assertDatabaseHas('categories', [
            'name' => 'trivia'
        ]);
        $response->assertStatus(200);
        $response->assertSee('雑学');
        $this->table_data_render($response);
    }
    public function test_quize_category_academic_screen_can_be_rendered()
    {
        $response = $this->get('/category/academic');
        $this->assertDatabaseHas('categories', [
            'name' => 'academic'
        ]);
        $response->assertStatus(200);
        $response->assertSee('学問');
        $this->table_data_render($response);
    }
}
