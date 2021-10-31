<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class QuizeGroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'information',
        'category_id',
        'has_content',
    ];

    // 共通
    private function quizeCategoryCommonQuery()
    {
        return DB::table('quize_groups')
            ->select(['quize_groups.id', 'title', 'name', 'users.id as user_id', 'goodCount' =>  $this->goodCountSubQuery()])
            ->join('users', 'users.id', '=', 'quize_groups.user_id')
            ->where('has_content', '=', '1');
    }
    private function goodCountSubQuery()
    {
        return function (Builder $query) {
            $query
                ->selectRaw('count(*)')
                ->from('goods')
                ->whereRaw('goods.quize_group_id = quize_groups.id')
                ->groupBy('quize_groups.id');
        };
    }
    // クエリ
    public function getQuizeGroup($id)
    {
        $quize_group = DB::table('quize_groups')
            ->select(DB::raw('users.id as user_id, quize_groups.id as group_id, users.name as username, categories.name as category_name_jp, information, title'))
            ->join('categories', 'categories.id', '=', 'quize_groups.category_id')
            ->join('users', 'users.id', '=', 'quize_groups.user_id')
            ->where('quize_groups.id', '=', $id)
            ->first();

        return $quize_group;
    }
    public function getAllQuizeGroups()
    {
        $quize_groups =  $this->quizeCategoryCommonQuery()
            ->paginate(10);

        return $quize_groups;
    }
    public function getQuizeGroupsForEachCategory($category_id)
    {
        $quize_groups = $this->quizeCategoryCommonQuery()
            ->where('category_id', $category_id)
            ->paginate(10);

        return $quize_groups;
    }
    public function getEditListQuizeGroups()
    {
        $edit_list = DB::table('quize_groups')
            ->select(['quize_groups.id as quize_group_id', 'title', 'name_jp', 'goodCount' =>  $this->goodCountSubQuery()])
            ->join('categories', 'categories.id', '=', 'quize_groups.category_id')
            ->where('user_id', Auth::id())
            ->paginate(10);

        return $edit_list;
    }
    public function getUserQuizeGroups($user_id)
    {
        $quize_groups = DB::table('quize_groups')
            ->select(['name', 'user_id', 'name_jp', 'quize_groups.id as id', 'title', 'goodCount' =>  $this->goodCountSubQuery()])
            ->join('categories', 'categories.id', '=', 'quize_groups.id')
            ->where('user_id', $user_id)
            ->paginate(10);

        return $quize_groups;
    }
}
