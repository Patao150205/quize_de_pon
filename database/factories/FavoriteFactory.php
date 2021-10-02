<?php

namespace Database\Factories;

use App\Models\Favorite;
use App\Models\QuizeGroup;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavoriteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Favorite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomUser = User::all()->random();
        return [
            'user_id' => $randomUser->id,
            'quize_group_id' => QuizeGroup::where('user_id', $randomUser->id)->first()->id,
        ];
    }
}
