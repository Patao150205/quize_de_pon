<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Quize extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'question',
        'choice1',
        'choice2',
        'choice3',
        'choice4',
        'correct_choice',
        'explanation',
        'sort_num',
        'user_id',
        'quize_group_id',
    ];

    public function fetchQuize($group_id, $sort_num)
    {
        $quize_quantity = DB::table('quizes')->where('quize_group_id', $group_id)->count();

        if ($quize_quantity != 0 && $sort_num <= $quize_quantity) {
            $quize = DB::table('quizes')->where('quize_group_id', $group_id)->where('sort_num', $sort_num)->first();
            $isLast = $sort_num == $quize_quantity ? 'true' : 'false';

            return ['quize' => $quize, 'isLast' => $isLast];
        } else {
            return false;
        }
    }
    public function getQuizeCount($quize_group_id)
    {
        $count = $this->where('quize_group_id', $quize_group_id)->count();

        return $count;
    }
    public function registQuizes($group_id, $data)
    {
        if (!empty($data)) {
            DB::transaction(function () use ($group_id, $data) {
                QuizeGroup::where('user_id', Auth::id())
                    ->where('id', $group_id)
                    ->update(['has_content' => 1]);

                Quize::insert($data);
            }, 3);
        }
    }
    public function updateQuizzesWithoutContents($group_id)
    {
        DB::transaction(function () use ($group_id) {
            QuizeGroup::where('user_id', Auth::id())
                ->where('id', $group_id)
                ->update(['has_content' => 0]);

            Quize::join('quize_groups', 'quize_groups.id', '=', 'quizes.quize_group_id')
                ->where('quizes.user_id', Auth::id())
                ->where('quize_group_id', $group_id)
                ->delete();
        }, 3);
    }
    public function updateQuizzes($group_id, $data)
    {
        DB::transaction(function () use ($group_id, $data) {
            Quize::join('quize_groups', 'quize_groups.id', '=', 'quizes.quize_group_id')
                ->where('quizes.user_id', Auth::id())
                ->where('quize_group_id', $group_id)
                ->delete();
            QuizeGroup::where('user_id', Auth::id())
                ->where('id', $group_id)
                ->update(['has_content' => 1]);

            Quize::insert($data);
        }, 3);
    }
}
