<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Guess;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guess>
 */
class GuessFactory extends Factory
{

    protected $model = Guess::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id ?? \App\Models\User::factory(),
            'object_id' => \App\Models\Objects::inRandomOrder()->first()->id ?? \App\Models\Objects::factory(),
            'guessed_price' => $this->faker->randomFloat(2, 10, 500),
            'score' => $this->faker->numberBetween(0, 3),
            'time_taken' => $this->faker->numberBetween(5, 60),
            'attempt_number' => $this->faker->numberBetween(1, 5),
            'feedback' => $this->faker->randomElement(['Bien joué !', 'Pas tout à fait...', 'Presque !']),
        ];
    }
}
