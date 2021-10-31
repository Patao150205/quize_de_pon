<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\QuizeGroup;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = DB::table('categories')->select('name_jp', 'name')->get();

        return view('category.index', compact('categories'));
    }
    public function show($category_name, QuizeGroup $quize_group_md, Category $category_md)
    {
        $category = null;

        if ($category_name === 'all') {
            $quize_groups =  $quize_group_md->getAllQuizeGroups();
        } else {
            $category = $category_md->searchCategoryInfo($category_name);
            $quize_groups =  $quize_group_md->getQuizeGroupsForEachCategory($category->id);
        }

        return view('category.show', compact('quize_groups', 'category'));
    }
}
