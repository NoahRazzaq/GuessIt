<?php

namespace Database\Factories;

use App\Models\GameObject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Object>
 */
class GameObjectFactory extends Factory
{
    protected $model = GameObject::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'image_path' => $this->faker->imageUrl(640, 480, 'products'),
            'real_price' => $this->faker->numberBetween(5,10),
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id ?? \App\Models\Category::factory(),
        ];
    }
}
