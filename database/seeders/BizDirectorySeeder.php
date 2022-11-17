<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BizDirectorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //$directory1 = Bizdirectory::create(['business_name_slug' => 'adepet-organization', 'description' => $faker->sentence, 'number_of_employees' => '20', 'website' => $faker->url, 'established' => '1988', 'location' => $faker->address]);
        \App\Models\Bizdirectory::factory(10)->create();
    }
}
