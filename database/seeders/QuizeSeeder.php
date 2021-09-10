<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quizes')->insert([
            [
                'question' => 'ルフィーはどこ出身か？',
                'choice1' => 'New York',
                'choice2' => '千代田区',
                'choice3' => 'ザバス',
                'choice4' => 'フーシャ村',
                'answer_choice' => 'choice4',
                'explanation' => 'ルフィーはフーシャ村出身です！',
                'quize_group_id' => 2,
                'sort_num' => 1,
            ]
        ]);
    }
}
