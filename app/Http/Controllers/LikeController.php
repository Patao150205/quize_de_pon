<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Good;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function favoriteIndex(Favorite $favorite_md)
    {
        $favorites = $favorite_md->fetchFavorites();

        return view('favorite.index', compact('favorites'));
    }
    public function toggleFavorite($groupId, $user_id)
    {
        $isFavorite = Favorite::where('quize_group_id', $groupId)->where('user_id', $user_id)->exists();

        if (!$isFavorite) {
            Favorite::create([
                'quize_group_id' => $groupId,
                'user_id' => $user_id
            ]);
            return response('inc')->header('Content-Type', 'text/plain');
        } else {
            Favorite::where('quize_group_id', $groupId)->where('user_id', $user_id)->delete();

            return response('dec')->header('Content-Type', 'text/plain');
        }
    }
    public function toggleGood($groupId, $user_id)
    {
        $isGood = Good::where('quize_group_id', $groupId)->where('user_id', $user_id)->exists();

        if (!$isGood) {
            Good::create([
                'quize_group_id' => $groupId,
                'user_id' => $user_id
            ]);

            return response('inc')->header('Content-Type', 'text/plain');
        } else {
            Good::where('quize_group_id', $groupId)->where('user_id', $user_id)->delete();

            return response('dec')->header('Content-Type', 'text/plain');
        }
    }
}
