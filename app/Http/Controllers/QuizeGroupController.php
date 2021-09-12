<?php

namespace App\Http\Controllers;

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
        return view('quize-group.create');
    }
    public function store(Request $request)
    {
        dd($request);
        $data = QuizeGroup::create([
            'title' => $request->title,
            'information' => $request->information,
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
        ]);

        $id = $data->id;

        redirect()->route('quize.create', ['quize' => $id]);
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


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
