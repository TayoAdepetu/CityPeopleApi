<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
//use App\Models\Jobsdirectory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jobsdirectory>
 */
class JobsdirectoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title= $this->faker->text($maxNbChars = 20);
        $job_slug = str_slug($title, '-');
        $salary = 26000;

        return [
            //
            'title' => $title,  
            'job_slug' => $job_slug,
            'salary' => $salary,
            'location' => $this->faker->text($maxNbChars = 40),
            'function' => $this->faker->text($maxNbChars = 40),
            'description' => $this->faker->text($maxNbChars = 40),
            //'bizdirectory_id' => User::factory()
        ];
    }
}
