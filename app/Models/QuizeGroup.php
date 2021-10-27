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

    public function getAllQuizeGroups()
    {
        $quize_groups = DB::table('quize_groups')
            ->select(['quize_groups.id as quize_group_id', 'title', 'name_jp', 'goodCount' => function (Builder $query) {
                $query
                    ->selectRaw('count(*)')
                    ->from('goods')
                    ->whereRaw('goods.quize_group_id = quize_groups.id')
                    ->groupBy('quize_groups.id');
            }])
            ->join('categories', 'categories.id', '=', 'quize_groups.category_id')
            ->where('user_id', Auth::id())
            ->paginate(10);

        return $quize_groups;
    }
    public function getQuizeGroupsForEachCategory($category_id)
    {
        $quize_groups = DB::table('quize_groups')
            ->select(['quize_groups.id', 'title', 'name', 'users.id as user_id', 'goodCount' => function (Builder $query) {
                $query
                    ->selectRaw('count(*)')
                    ->from('goods')
                    ->whereRaw('goods.quize_group_id = quize_groups.id')
                    ->groupBy('quize_groups.id');
            }])
            ->join('users', 'users.id', '=', 'quize_groups.user_id')
            ->where('has_content', '=', '1')
            ->where('category_id', $category_id)
            ->paginate(10);

        return $quize_groups;
    }
}
