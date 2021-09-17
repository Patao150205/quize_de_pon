<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\QuizeGroup;
use App\Services\LikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder as QueryBuilder;

class QuizeGroupController extends Controller
{
    // クイズ作成メニュー
    public function menu()
    {
        return view('quize-group.menu');
    }
    public function result($id)
    {
        $group = DB::table('quize_groups')
            ->select()
            ->where('id', $id)
            ->get();

        if ($group->isEmpty()) {
            abort('404');
        }

        $count = DB::table('quizes')
            ->select(DB::raw('count(*) as count'))
            ->where('quize_group_id', $id)
            ->get()[0]->count;

        $status = LikeService::searchLikeStatus($group[0]->id);

        return view('quize-group.result', ['group' => $group[0], 'count' => $count], $status);
    }
    public function create()
    {
        $categories =  Category::all(['id', 'name_jp']);

        return view('quize-group.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $data = QuizeGroup::create([
            'title' => $request->title,
            'information' => $request->information,
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
        ]);

        $id = $data->id;

        return redirect()->route('quize.create', ['quize_group' => $id]);
    }
    // クイズグループ
    public function show($id)
    {
        $group = DB::table('quize_groups')
            ->select(DB::raw('users.id as user_id, quize_groups.id as group_id, users.name as username, categories.name as category_name_jp, information, title'))
            ->join('categories', 'categories.id', '=', 'quize_groups.category_id')
            ->join('users', 'users.id', '=', 'quize_groups.user_id')
            ->where('quize_groups.id', '=', $id)
            ->get();

        if ($group->isEmpty()) {
            abort('404');
        }

        $status = LikeService::searchLikeStatus($group[0]->group_id);

        return view('quize-group.show', ['group' => $group[0]], $status);
    }
    public function editList()
    {
        $quize_groups = DB::table('quize_groups')
            ->select(['quize_groups.id as quize_group_id', 'title', 'name_jp', 'goodCount' => function (QueryBuilder $query) {
                $query
                    ->selectRaw('count(*)')
                    ->from('goods')
                    ->whereRaw('goods.quize_group_id = quize_groups.id')
                    ->groupBy('quize_groups.id');
            }])
            ->join('categories', 'categories.id', '=', 'quize_groups.category_id')
            ->where('user_id', Auth::id())
            ->paginate(10);

        return view('quize-group.edit-list', compact('quize_groups'));
    }
    public function edit($id)
    {
        $group = DB::table('quize_groups')
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->get();

        if ($group->isEmpty()) {
            abort('404');
        }

        $categories =  Category::all(['id', 'name_jp']);

        return view('quize-group.edit', ['group' => $group[0]], compact('categories'));
    }
    public function update(Request $request, $id)
    {
        QuizeGroup::where('id', $id)
            ->where('user_id', Auth::id())
            ->update([
                'title' => $request->title,
                'information' => $request->information,
                'category_id' => $request->category_id
            ]);

        return redirect()->route('quize.edit', ['quize_group' =>  $id]);
    }
    public function destroy($id)
    {
    }
}
