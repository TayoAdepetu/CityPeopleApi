<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;

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
        $title= $this->faker->sentence;
        $slug = str_slug($title, '-');

        return [
            //
            'title' => $title,  
            'description' => $this->faker->sentence,
            'slug' => $slug,
            'body' => $this->faker->paragraph(30),
            'user_id' => User::factory() 
        ];
    }
}
