<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
//use App\Models\WorkingHours;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkingHours>
 */
class WorkingHoursFactory extends Factory
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
        $time = '8am-6pm';

        return [
            //
            'business_name' => $business_name,  
            'slug' => $slug,
            'monday' => $time,
            'tuesday' => $time,
            'wednesday' => $time,
            'thursday' => $time,
            'friday' => $time,
            'saturday' => $time,
            'sunday' => $time,
            'user_id' => User::factory() 
        ];
    }
}
