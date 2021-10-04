<?php

namespace Database\Factories;

use App\Models\EmailVerification;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailVerificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EmailVerification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'token' => uniqid('', true),
            'expiration_datetime' => now()->addHour(1),
        ];
    }
}
