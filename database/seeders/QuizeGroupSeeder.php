<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizeGroupSeeder extends Seeder
{
    public function run()
    {
        DB::table('quize_groups')->insert([
            [
                'title' => 'ワンピース',
                'information' => '人気アニメワンピースの問題',
                'has_content' => 1,
                'user_id' => 1,
                'category_id' => 1,
                'created_at' => '2021/02/02 11:11:11',
                'updated_at' => '2021/02/02 11:11:11'
            ],
            [
                'title' => '世界一シリーズ',
                'information' => 'とれが世界一の記録かを当てよう！驚きの結果かも？？',
                'has_content' => 1,
                'user_id' => 1,
                'category_id' => 4,
                'created_at' => '2021/02/02 11:11:11',
                'updated_at' => '2021/02/02 11:11:11'
            ],
            [
                'title' => '江戸の歴史',
                'information' => '江戸時代の歴史問題です。',
                'has_content' => 1,
                'user_id' => 1,
                'category_id' => 5,
                'created_at' => '2021/02/02 11:11:11',
                'updated_at' => '2021/02/02 11:11:11'
            ],
            [
                'title' => '競技クイズ',
                'information' => '競技についてのクイズ！',
                'has_content' => 1,
                'user_id' => 1,
                'category_id' => 2,
                'created_at' => '2021/02/02 11:11:11',
                'updated_at' => '2021/02/02 11:11:11'
            ],
        ]);
    }
}
