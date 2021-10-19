<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikeService
{
	public static function searchLikeStatus($id)
	{
		$userId = Auth::id();

		$goodCount =  DB::table('goods')
			->select(DB::raw('count(*) as count'))
			->where('quize_group_id', $id)
			->get()[0]->count;

		if (is_null($userId)) {
			return [
				'isGood' => null,
				'isFavorite' => null,
				'goodCount' => $goodCount,
			];
		} else {


			if (!is_null($userId)) {
				$isGood = DB::table('goods')
					->where('quize_group_id', $id)
					->where('user_id', Auth::id())
					->exists();

				$isFavorite = DB::table('favorites')
					->where('quize_group_id', $id)
					->where('user_id', Auth::id())
					->exists();
			}

			return [
				'isGood' => $isGood,
				'isFavorite' => $isFavorite,
				'goodCount' => $goodCount,
			];
		}
	}
}
