<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizeGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quize_groups')->insert([
            [
                'title' => 'ためにならない知識問題',
                'information' => 'くだらない知っても役に立たない問題たち、誰得だよ笑',
                'user_id' => 1,
                'category_id' => 4,
            ],
            [
                'title' => 'ワンピース',
                'information' => '人気アニメワンピースの問題',
                'user_id' => 1,
                'category_id' => 1,
            ],
            [
                'title' => '江戸の歴史',
                'information' => '江戸時代の歴史問題です。',
                'user_id' => 1,
                'category_id' => 5,
            ],
        ]);
    }
}
