<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateQuizeTest extends TestCase
{
    public function test_create_quize_unauthenticated_screen_can_be_rendered()
    {
        $response = $this->get('/quize_group/menu');

        $response->assertStatus(200);
        $response->assertSee('ログインしていません。');
    }
}
