<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Query\Builder as QueryBuilder;

class UserController extends Controller
{
    public function show($id)
    {
        $user = DB::table('users')
            ->select(['id', 'name', 'profile_img', 'profile'])
            ->where('id', $id)
            ->get();

        if ($user->isEmpty()) {
            abort('404');
        }

        $quize_groups = DB::table('quize_groups')
            ->select(['name', 'user_id', 'name_jp', 'quize_groups.id as id', 'title', 'goodCount' => function (QueryBuilder $query) {
                $query
                    ->selectRaw('count(*)')
                    ->from('goods')
                    ->whereRaw('goods.quize_group_id = quize_groups.id')
                    ->groupBy('quize_groups.id');
            }])
            ->join('categories', 'categories.id', '=', 'quize_groups.id')
            ->where('user_id', $id)
            ->paginate(10);

        return view('user.show', ['user' => $user[0]], compact('quize_groups'));
    }
    public function edit()
    {
        $user = User::firstOrFail()->select(['id', 'name', 'profile_img', 'profile'])->where('id', Auth::id())->first();

        return view('user.edit', compact('user'));
    }
    public function update(Request $request)
    {
        // 画像の圧縮
        $file = $request->profile_img;

        if (!is_null($file)) {
            $filename = date('Y-m-d-H:i:s') . '-' . $file->getClientOriginalName();

            $compressedImg =  \InterventionImage::make($file)->resize(160, 100)->encode();
            Storage::put('public/profile_img/' . $filename, $compressedImg);

            if (!is_null($request->before_img_name)) {
                $targetImg = 'public/profile_img/' . $request->before_img_name;
                Storage::delete($targetImg);
            }
        }

        User::where('id', Auth::id())
            ->update([
                'name' => $request->name,
                'profile' => $request->profile,
                'profile_img' => $filename ?? $request->before_img_name,
            ]);

        return redirect()->route('user.show', ['user' => Auth::id()]);
    }
}
