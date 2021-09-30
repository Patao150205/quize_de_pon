<?php

namespace Tests\Feature;

use App\Models\Quize;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuizeTest extends TestCase
{
    use RefreshDatabase;

    public function test_render_question_list_info_can_be_rendered()
    {
        $response = $this->get('/quize_group/1');

        $response->assertStatus(200);
    }
    public function test_render_questions_can_be_rendered()
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
    public function test_render_questions_result_can_be_rendered()
    {
        $response = $this->get('quize_group/1/result');
        $response->assertSee('クイズ成績');
        $response->assertStatus(200);
    }
}
