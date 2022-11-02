<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bizdirectoryproducts>
 */
class BizdirectoryproductsFactory extends Factory
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
            'business_name' => $business_name,
            'slug' => $slug,
            'description' => $this->faker->sentence,
            'biz_location' => $this->faker->sentence,
            'product_name' => $this->faker->text($maxNbChars = 20),
            'phone' => $this->faker->phoneNumber,
            'user_id' => User::factory()
        ];
    }
}
