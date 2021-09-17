<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->select('name_jp', 'name')->get();
        return view('category.index', compact('categories'));
    }
    public function show($category_name)
    {
        $category = null;

        if ($category_name === 'all') {
            $quize_groups = DB::table('quize_groups')
                ->select(['quize_groups.id', 'title', 'name', 'users.id as user_id', 'goodCount' => function (QueryBuilder $query) {
                    $query
                        ->selectRaw('count(*)')
                        ->from('goods')
                        ->whereRaw('goods.quize_group_id = quize_groups.id')
                        ->groupBy('quize_groups.id');
                }])
                ->join('users', 'users.id', '=', 'quize_groups.user_id')
                ->where('has_content', '=', '1')
                ->paginate(10);
        } else {
            $category = DB::table('categories')
                ->select('id', 'name_jp')
                ->where('name', '=', $category_name)
                ->get();
            if ($category->isEmpty()) {
                abort('404');
            }
            $category = $category[0];
            $quize_groups = DB::table('quize_groups')
                ->select(['quize_groups.id', 'title', 'name', 'users.id as user_id', 'goodCount' => function (QueryBuilder $query) {
                    $query
                        ->selectRaw('count(*)')
                        ->from('goods')
                        ->whereRaw('goods.quize_group_id = quize_groups.id')
                        ->groupBy('quize_groups.id');
                }])
                ->join('users', 'users.id', '=', 'quize_groups.user_id')
                ->where('has_content', '=', '1')
                ->where('category_id', $category->id)
                ->paginate(10);
        }

        return view('category.show', compact('quize_groups', 'category'));
    }
}
