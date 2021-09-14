<?php

namespace Database\Seeders;

use App\Models\Quize;
use Illuminate\Database\Seeder;

class QuizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quize::insert([
            [
                'question' => 'ルフィーはどこ出身か？',
                'choice1' => 'New York',
                'choice2' => '千代田区',
                'choice3' => 'ザバス',
                'choice4' => 'フーシャ村',
                'correct_choice' => 'choice4',
                'explanation' => 'ルフィーはフーシャ村出身です！',
                'user_id' => 1,
                'quize_group_id' => 2,
                'sort_num' => 1,
            ],
            [
                'question' => 'ルフィーはどこ出身か？',
                'choice1' => 'New York',
                'choice2' => '千代田区',
                'choice3' => 'ザバス',
                'choice4' => 'フーシャ村',
                'correct_choice' => 'choice4',
                'explanation' => 'ルフィーはフーシャ村出身です！',
                'user_id' => 1,
                'quize_group_id' => 2,
                'sort_num' => 2,
            ],
        ]);
    }
}
