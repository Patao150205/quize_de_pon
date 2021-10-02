<?php

namespace Database\Factories;

use App\Models\Quize;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuizeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quize::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question' => $this->faker->realText(100),
            'choice1' => $this->faker->realText(10),
            'choice2' => $this->faker->realText(10),
            'choice3' => $this->faker->realText(10),
            'choice4' => $this->faker->realText(10),
            'explanation' => $this->faker->realText(100),
            'correct_choice' => 'choice4',
            'quize_group_id' => 1,
            'user_id' => 1,
            'sort_num' => 1
        ];
    }
}
