<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FavoriteTest extends TestCase
{
    // public function test_favorite_screen_can_be_rendered()
    // {
    //     $user = User::factory()->create();
    //     $response = $this->actingAs($user)->get('/');


    //     $response->assertSee('ユーザー');
    //     $response->assertSee('タイトル');
    //     $response->assertSee('カテゴリ');

    //     $response->assertStatus(200);
    // }

    public function test_favorite_unauthenticated_screen_can_be_rendered()
    {
        $response = $this->get('/favorite');
        $response->assertStatus(200);
        $response->assertSee('ログインしていません。');
    }
}
