<?php

namespace App\Http\Controllers;

use App\Models\QuizeGroup;
use App\Models\User;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function show($id, QuizeGroup $quize_groups_md)
    {
        $user = DB::table('users')
            ->select(['id', 'name', 'profile_img', 'profile'])
            ->where('id', $id)
            ->first();

        if (empty($user)) {
            abort('404');
        }

        $quize_groups = $quize_groups_md->getUserQuizeGroups($id);

        return view('user.show', ['user' => $user], compact('quize_groups'));
    }
    public function edit()
    {
        $user = User::firstOrFail()->select(['id', 'name', 'profile_img', 'profile'])->where('id', Auth::id())->first();

        return view('user.edit', compact('user'));
    }
    public function update(Request $request, ImageService $imageService)
    {
        // 画像の圧縮
        $file = $request->profile_img;
        $before_img_name = $request->before_img_name;

        if (!is_null($file)) {
            $imageService->uploadImage($file, $before_img_name);
        }

        User::where('id', Auth::id())
            ->update([
                'name' => $request->name,
                'profile' => $request->profile,
                'profile_img' => $filename ?? $before_img_name,
            ]);

        return redirect()->route('user.show', ['user' => Auth::id()]);
    }
}
