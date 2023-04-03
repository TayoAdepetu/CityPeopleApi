<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //we call out the factory classes here so that they can populate the tables when seeded
        //$this->call(User::class);
        //$this->call(BizDirectory::class);
        //$this->call(Bizdirectoryproducts::class);
        //$this->call(Category::class);
        //$this->call(Faqs::class);
        //$this->call(Jobsdirectory::class);
        //$this->call(Post::class);
        //$this->call(Secret::class);
        //$this->call(WorkingHours::class);

    DB::table('users')->insert([
         'name' => "Tayo",
         'email' => "teewrites1993@gmail.com",
         'scope' => 'superadmin',
         'email_verified_at' => now(),
         'password' => app('hash')->make('Adetayowale00001111olamitobiesther'),
         //'public_reference_id' => '61ea9086bf786',
         //'avatar' => config('chatify.user_avatar.default')
       ]);

    DB::table('users')->insert([
         'name' => "TeeWhy",
         'email' => "copyafrica1993@gmail.com",
         'scope' => 'admin',
         'email_verified_at' => now(),
         'password' => app('hash')->make('Adetayowale0011olamitobi'),
         //'public_reference_id' => '61ea9086bf786',
         //'avatar' => config('chatify.user_avatar.default')
       ]);

    DB::table('users')->insert([
         'name' => "Olamitobi",
         'email' => "tayowrites93@gmail.com",
         'scope' => 'commenter',
         'email_verified_at' => now(),
         'password' => app('hash')->make('Adetayowale001olamitobi'),
         //'public_reference_id' => '61ea9086bf786',
         //'avatar' => config('chatify.user_avatar.default')
       ]);

    DB::table('users')->insert([
         'name' => "Olawale",
         'email' => "adepetuoluwatayo@gmail.com",
         'scope' => 'seller',
         'email_verified_at' => now(),
         'password' => app('hash')->make('Adetayowale01olamitobi'),
         //'public_reference_id' => '61ea9086bf786',
         //'avatar' => config('chatify.user_avatar.default')
       ]);
}

}
