<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(5),
            'slug' => Str::slug($this->faker->sentence(5)),
            'image' => basename(collect(glob(public_path('storage/posts/*')))->random()),
            'is_pinned' =>  mt_rand(0, 1),
            'content' => $this->faker->paragraphs(3, true),
            'created_by' => $this->faker->name(),
        ];
    }
}
