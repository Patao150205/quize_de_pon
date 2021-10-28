<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quize_group_id'
    ];

    public function fetchFavorites()
    {
        $favorites = DB::table('favorites')
            ->select(DB::raw('quize_groups.user_id as user_id, quize_groups.id as quize_group_id ,title, users.name, name_jp, categories.name as category_name'))
            ->join('quize_groups', 'quize_groups.id', '=', 'favorites.quize_group_id')
            ->join('categories', 'categories.id', '=', 'quize_groups.category_id')
            ->join('users', 'users.id', '=', 'quize_groups.user_id')
            ->where('favorites.user_id', Auth::id())
            ->paginate(10);

        return $favorites;
    }
}
