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

        if ($category_name === 'random') {
            $category =  DB::table('categories')->get();
        } else {
            $category = DB::table('categories')->where('name', '=', $category_name)->get();
        }

        if ($category->isEmpty()) {
            abort('404');
        }


        $category = $category[0];


        $quize_groups = DB::table('quize_groups')->where('category_id', $category->id)->get();
        return view('category.show', compact('quize_groups', 'category'));
    }
}
