<?php

namespace App\Http\Controllers;

use App\Services\LikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizeController extends Controller
{
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
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
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
    // クイズ単体
    public function showQuize($group_id, $sort_num)
    {
        if ($sort_num <= 0) {
            abort('404');
        }

        $quize_quantity = DB::table('quizes')->select(DB::raw('count(*) as quantity'))->where('quize_group_id', $group_id)->get()[0]->quantity;

        if ($quize_quantity != 0 && $sort_num <= $quize_quantity) {
            $quize = DB::table('quizes')->where('quize_group_id', $group_id)->where('sort_num', $sort_num)->get()[0];
            $isLast = $sort_num == $quize_quantity ? 'true' : 'false';
        } else {
            abort('404');
        }


        return view('quize.show', compact('quize', 'isLast'));
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
