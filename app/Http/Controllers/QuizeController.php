<?php

namespace App\Http\Controllers;

use App\Models\Quize;
use App\Models\QuizeGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizeController extends Controller
{
    public function create($quize_group_id)
    {
        $group = QuizeGroup::where('user_id', Auth::id())
            ->where('id', $quize_group_id)
            ->get();

        if ($group->isEmpty()) {
            abort(404);
        }

        if ($group[0]->has_content != 0) {
            return redirect()->route('quize_group.menu');
        }

        return view('quize.create', ['group' => $group[0]]);
    }
    public function store(Request $request)
    {
        $json = $request->getContent();
        $data = json_decode($json, true);
        $array_length = count($data);
        $group_id = $data[$array_length - 1][0];

        array_pop($data);

        $is_exists = QuizeGroup::where('id', $group_id)->exists();
        if (!$is_exists) {
            return response('更新対象のクイズ集が存在しません。', 404);
        }

        DB::transaction(function () use ($group_id, $data) {
            Quize::join('quize_groups', 'quize_groups.id', '=', 'quizes.quize_group_id')
                ->where('quizes.user_id', Auth::id())
                ->where('quize_group_id', $group_id)
                ->delete();
            QuizeGroup::where('user_id', Auth::id())
                ->where('id', $group_id)
                ->update(['has_content' => 1]);

            Quize::insert($data);
        }, 3);

        return response($group_id)->header('Content-Type', 'text/plain');
    }
    // クイズ単体
    public function show($group_id, $sort_num)
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
    public function edit($id)
    {
        $group = QuizeGroup::where('quize_groups.id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (is_null($group)) {
            return abort(404);
        }

        $quizzes = Quize::where('user_id', Auth::id())
            ->where('quize_group_id', $id)
            ->get();

        return view('quize.edit', compact('group', 'quizzes'));
    }
    public function update(Request $request)
    {
        $json = $request->getContent();
        $data = json_decode($json, true);
        $array_length = count($data);
        $group_id = $data[$array_length - 1][0];

        $is_exists = QuizeGroup::where('id', $group_id)->exists();

        if (!$is_exists) {
            return response('アップデート対象が存在しません。', 404);
        }

        if ($array_length === 1) {
            DB::transaction(function () use ($group_id) {
                QuizeGroup::where('user_id', Auth::id())
                    ->where('id', $group_id)
                    ->update(['has_content' => 0]);

                Quize::join('quize_groups', 'quize_groups.id', '=', 'quizes.quize_group_id')
                    ->where('quizes.user_id', Auth::id())
                    ->where('quize_group_id', $group_id)
                    ->delete();
            }, 3);
        } else {
            array_pop($data);

            DB::transaction(function () use ($group_id, $data) {
                Quize::join('quize_groups', 'quize_groups.id', '=', 'quizes.quize_group_id')
                    ->where('quizes.user_id', Auth::id())
                    ->where('quize_group_id', $group_id)
                    ->delete();
                QuizeGroup::where('user_id', Auth::id())
                    ->where('id', $group_id)
                    ->update(['has_content' => 1]);

                Quize::insert($data);
            }, 3);
        }

        return response($group_id)->header('Content-Type', 'text/plain');
    }
}
