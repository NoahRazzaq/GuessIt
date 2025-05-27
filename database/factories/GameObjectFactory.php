<?php

namespace Database\Factories;

use App\Models\GameObject;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GameObject>
 */
class GameObjectFactory extends Factory
{
    protected $model = GameObject::class;

    public function definition(): array
    {
        // ⚠️ Assure-toi que cette image existe localement
        $localImagePath = storage_path('app/public/seeder-images/image.jpg');

        // Upload vers S3/MinIO (dans le dossier "objects")
        $uploadedPath = Storage::disk('s3')->putFile('objects', new File($localImagePath));

        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence(),
            'image_path' => $uploadedPath, // sera accessible via Storage::disk('s3')->url($image_path)
            'real_price' => $this->faker->numberBetween(5, 10),
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id ?? \App\Models\Category::factory(),
        ];
    }
}
