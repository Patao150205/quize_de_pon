<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Quize;
use App\Models\QuizeGroup;
use App\Services\LikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizeGroupController extends Controller
{
    // クイズ作成メニュー
    public function menu()
    {
        return view('quize-group.menu');
    }
    public function create()
    {
        $categories = Category::all(['id', 'name_jp']);

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
    public function show($id, Quize $quizemd)
    {
        $quize_groupmd = new QuizeGroup();
        $group = $quize_groupmd->getQuizeGroup($id);

        if (empty($group)) {
            abort('404');
        }

        $status = LikeService::searchLikeStatus($group->group_id);

        return view('quize-group.show', ['group' => $group, 'count' => $quizemd->getQuizeCount($group->group_id)], $status);
    }
    public function result($id, Quize $quizemd)
    {
        $group = DB::table('quize_groups')
            ->where('id', $id)
            ->first();

        if (empty($group)) {
            abort('404');
        }

        $status = LikeService::searchLikeStatus($group->id);

        return view('quize-group.result', ['group' => $group, 'count' => $quizemd->getQuizeCount($group->id)], $status);
    }
    public function editList()
    {
        $quize_group_md = new QuizeGroup();
        $quize_groups = $quize_group_md->getEditListQuizeGroups();
        return view('quize-group.edit-list', compact('quize_groups'));
    }
    public function edit($id)
    {
        $group = DB::table('quize_groups')
            ->where('user_id', Auth::id())
            ->where('id', $id)
            ->get();

        if ($group->isEmpty()) {
            return abort('404');
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
        $quize_group = QuizeGroup::where('id', $id)->exists();

        if ($quize_group) {
            QuizeGroup::destroy($id);
            return '削除に成功しました。';
        } else {
            return response('削除対象が存在しません', 404);
        }
    }
}
