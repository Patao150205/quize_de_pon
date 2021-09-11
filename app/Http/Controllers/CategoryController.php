<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
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
            $quize_groups = DB::table('quize_groups')->select('quize_groups.id', 'title', 'name', 'users.id as user_id')->join('users', 'users.id', '=', 'quize_groups.user_id')->get();
        } else {
            $category = DB::table('categories')->select('id', 'name_jp')->where('name', '=', $category_name)->get();
            if ($category->isEmpty()) {
                abort('404');
            }
            $category = $category[0];
            $quize_groups = DB::table('quize_groups')->select('quize_groups.id', 'title', 'name', 'users.id as user_id')->join('users', 'users.id', '=', 'quize_groups.user_id')->where('category_id', $category->id)->get();
        }

        $goodCount = DB::table('goods')->select(DB::raw('count(*) as goodCount'))->get()[0]->goodCount;

        return view('category.show', compact('quize_groups', 'category', 'goodCount'));
    }
}
