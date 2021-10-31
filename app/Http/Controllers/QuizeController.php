<?php

namespace App\Http\Controllers;

use App\Models\Quize;
use App\Models\QuizeGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizeController extends Controller
{
    public function create($quize_group_id)
    {
        $group = QuizeGroup::where('user_id', Auth::id())
            ->where('id', $quize_group_id)
            ->first();

        if (empty($group)) {
            abort(404);
        }

        if ($group->has_content != 0) {
            return redirect()->route('quize_group.menu');
        }

        return view('quize.create', compact('group'));
    }
    public function store(Request $request, Quize $quize_md)
    {
        // データ処理
        $json = $request->getContent();
        $data = json_decode($json, true);
        $array_length = count($data);
        $group_id = $data[$array_length - 1][0];
        array_pop($data);

        $is_exists = QuizeGroup::where('id', $group_id)->exists();
        if (!$is_exists) {
            return response('更新対象のクイズ集が存在しません。', 404);
        }

        $quize_md->registQuizes($group_id, $data);

        return response($group_id)->header('Content-Type', 'text/plain');
    }
    // クイズ単体
    public function show($group_id, $sort_num, Quize $quize_md)
    {
        if ($sort_num <= 0) {
            return abort('404');
        }

        $quize_info = $quize_md->fetchQuize($group_id, $sort_num);

        if ($quize_info === false) {
            return abort('404');
        }

        return view('quize.show', ['quize' => $quize_info['quize'], 'isLast' => $quize_info['isLast']]);
    }
    public function edit($id)
    {
        $group = QuizeGroup::where('quize_groups.id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (empty($group)) {
            return abort(404);
        }

        $quizzes = Quize::where('user_id', Auth::id())
            ->where('quize_group_id', $id)
            ->get();

        return view('quize.edit', compact('group', 'quizzes'));
    }
    public function update(Request $request, Quize $quize_md)
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
            $quize_md->updateQuizzesWithoutContents($group_id);
        } else {
            array_pop($data);
            $quize_md->updateQuizzes($group_id, $data);
        }

        return response($group_id)->header('Content-Type', 'text/plain');
    }
}
