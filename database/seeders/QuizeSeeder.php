<?php

namespace Database\Seeders;

use App\Models\Quize;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizeSeeder extends Seeder
{
    public function run()
    {
        DB::table('quizes')->insert([
            [
                'question' => 'ルフィーはどこ出身か？',
                'choice1' => 'New York',
                'choice2' => '千代田区',
                'choice3' => 'ザバス',
                'choice4' => 'フーシャ村',
                'correct_choice' => 'choice4',
                'explanation' => 'ルフィーはフーシャ村出身です！',
                'user_id' => 1,
                'quize_group_id' => 1,
                'sort_num' => 1,
            ],
            [
                'question' => 'バギーが食べた悪魔の実は？',
                'choice1' => 'バラバラの実',
                'choice2' => 'ゴムゴムの実',
                'choice3' => 'ヤミヤミの実',
                'choice4' => 'バキバキのみ',
                'correct_choice' => 'choice1',
                'explanation' => 'バギが食べた悪魔の実はバラバラの実です！',
                'user_id' => 1,
                'quize_group_id' => 1,
                'sort_num' => 2,
            ],
            [
                'question' => '大相撲の本場所は年に何回ある？',
                'choice1' => '3回',
                'choice2' => '2回',
                'choice3' => '4回',
                'choice4' => '6回',
                'correct_choice' => 'choice4',
                'explanation' => '年6回です。',
                'user_id' => 1,
                'quize_group_id' => 4,
                'sort_num' => 1,
            ],
            [
                'question' => 'バスケットボールは、１チーム何人か？',
                'choice1' => '8人',
                'choice2' => '6人',
                'choice3' => '5人',
                'choice4' => '10人',
                'correct_choice' => 'choice3',
                'explanation' => '1チーム5人で行います。5人対5人で2チームでのプレーになります。',
                'user_id' => 1,
                'quize_group_id' => 4,
                'sort_num' => 2,
            ],
            [
                'question' => '日本国内のプロ野球のパ・リーグはなんの略称でしょうか？',
                'choice1' => 'パブリック・リーグ',
                'choice2' => 'パラダイス・リーグ',
                'choice3' => 'パシフィック・リーグ',
                'choice4' => 'パラ・リーグ',
                'correct_choice' => 'choice3',
                'explanation' => 'パシフィック・リーグは、日本のプロ野球リーグのひとつ。パ・リーグ、またはパと呼称される。',
                'user_id' => 1,
                'quize_group_id' => 4,
                'sort_num' => 3,
            ],
            [
                'question' => '人類史上、世界最高齢は何歳？',
                'choice1' => '131歳',
                'choice2' => '100歳',
                'choice3' => '112歳',
                'choice4' => '122歳',
                'correct_choice' => 'choice4',
                'explanation' => '122歳！！ジャンヌ＝ルイーズ・カルマン（Jeanne-Louise Calment、1875年2月21日 - 1997年8月4日）は、人類史上最も長生きをしたとされるフランス人女性',
                'user_id' => 1,
                'quize_group_id' => 2,
                'sort_num' => 1,
            ],
            [
                'question' => '世界最高個数のドミノ倒しの記録は何個でしょうか？',
                'choice1' => '約28万個',
                'choice2' => '約130万個',
                'choice3' => '約42万個',
                'choice4' => '約50万個',
                'correct_choice' => 'choice1',
                'explanation' => '
                ドイツで、277,245個のドミノを使ったドミノ倒しが行われました！！
                Youtubeにも動画があります！ https://www.youtube.com/watch?v=1QtdPfz_faM
                さまざまなギミックが仕込まれており、見ていても楽しめる内容になっています。
                ',
                'user_id' => 1,
                'quize_group_id' => 2,
                'sort_num' => 2,
            ],
            [
                'question' => '徳川家３代目将軍の名前は？',
                'choice1' => '徳川 慶喜',
                'choice2' => '徳川 家康',
                'choice3' => '徳川 家光',
                'choice4' => '徳川 家道',
                'correct_choice' => 'choice3',
                'explanation' => '徳川家光(江戸幕府の3代征夷大将軍（在職：1623年 - 1651年）)です！！',
                'user_id' => 1,
                'quize_group_id' => 3,
                'sort_num' => 1,
            ],
            [
                'question' => '江戸時代の大名について、関ヶ原の戦いの後に徳川家に従った大名についての名称は？',
                'choice1' => '親戚',
                'choice2' => '親藩',
                'choice3' => '譜代',
                'choice4' => '外様',
                'correct_choice' => 'choice3',
                'explanation' => '答えは...譜代です！！',
                'user_id' => 1,
                'quize_group_id' => 3,
                'sort_num' => 2,
            ],
        ]);
    }
}
