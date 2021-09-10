<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'anime_game',
                'name_jp' => 'アニメ＆ゲーム',
            ],
            [
                'name' => 'sports',
                'name_jp' => 'スポーツ',
            ],
            [
                'name' => 'entertainment',
                'name_jp' => '芸能',
            ],
            [
                'name' => 'trivia',
                'name_jp' => '雑学'
            ],
            [
                'name' => 'academic',
                'name_jp' => '学問'
            ],
        ]);
    }
}
