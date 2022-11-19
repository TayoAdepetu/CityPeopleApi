<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Bizdirectory;

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
        $product_name= $this->faker->text($maxNbChars = 20);
        $product_name_slug = str_slug($product_name, '-');
       // $bizdirectory_id = Bizdirectory::all()->random()->id;

        return [
            //
            //'bizdirectory_id' => $this->faker->unique()->$bizdirectory_id,
            'product_name_slug' => $product_name_slug,
            'description' => $this->faker->sentence,
            'location' => $this->faker->sentence,
            'product_name' => $product_name,
            //'phone' => $this->faker->phoneNumber,
            //'business_name' => $business_name,

        ];
    }
}
