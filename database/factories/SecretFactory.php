<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
//use App\Models\Secret;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Secret>
 */
class SecretFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {      
            //
            $title = $this->faker->text($maxNbChars = 20);
            $slug = str_slug($title, '-');
    
            return [
                //
                'title' => $title,  
                'description' => $this->faker->paragraph(2),
                'slug' => $slug,
            ];
    
    }
}
