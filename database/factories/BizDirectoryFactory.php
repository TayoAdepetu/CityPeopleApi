<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\biz-directory>
 */
class BizDirectoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
       // $business_name= $this->faker->text($maxNbChars = 20);
        //$slug = str_slug($business_name, '-');
       //$business_name = User::all()->pluck('business_name_slug')->toArray();
       //'business_name_slug' => User::inRandomOrder()->first()->business_name_slug,
       //'user_id' => $faker->unique()->numberBetween(1, App\User::count());
       $business_name_slug = User::all()->random()->business_name_slug;


        return [
            //
            'business_name_slug' => $this->faker->unique()->$business_name_slug,
            'description' => $this->faker->sentence,
            'location' => $this->faker->text($maxNbChars = 20),
            'website' => $this->faker->url,
            'number_of_employees' => $this->faker->randomDigitNotNull,
            'established' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            //'registered_here' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            //'phone' => $this->faker->phoneNumber,
            //'email' => $this->faker->email,
            //'user_id' => User::factory()

        ];
    }
}
