<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
//use App\Models\Faqs;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faqs>
 */
class FaqsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $business_name= $this->faker->text($maxNbChars = 20);
        $slug = str_slug($business_name, '-');

        return [
            //
            //'business_name' => $business_name,
            //'slug' => $slug,
            'question' => $this->faker->sentence,
            'answer' => $this->faker->sentence,
            //'bizdirectory_id' => User::factory()
        ];
    }
}
