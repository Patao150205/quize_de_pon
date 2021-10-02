<?php

namespace Database\Factories;

use App\Models\QuizeGroup;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizeGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = QuizeGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'information' => $this->faker->realText(100),
            'has_content' => 0,
            'user_id' => 1,
            'category_id' => 1,
        ];
    }
}
