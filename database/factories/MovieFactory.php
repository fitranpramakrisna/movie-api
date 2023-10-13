<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user_id = User::inRandomOrder()->first();

        $file = UploadedFile::fake()->image('test-image.jpg');
        $imageName = strtolower(Str::random(10))  . '.' . $file->getClientOriginalExtension();
        // $image->move(public_path('uploaded_img'), $imageName);

        return [
            'user_id' => $user_id,
            'title' => fake()->sentence(),
            'description' => fake()->text(200),
            'rating' => fake()->randomFloat(1, 0, 11),
            'image' => $imageName
        ];
    }
}
