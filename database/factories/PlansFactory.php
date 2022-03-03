<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class PlansFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'amount' => $this->faker->numberBetween($min = 1, $max = 10),
            'description' => $this->faker->paragraph(),
            'duration' => $this->faker->numberBetween($min = 1, $max = 3). ' month',
          //  'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
          //  'remember_token' => Str::random(10),
        ];
    }
}
