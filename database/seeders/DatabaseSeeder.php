<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
        $this->call(User::class);
        $this->call(BizDirectory::class);
        $this->call(Bizdirectoryproducts::class);
        $this->call(Category::class);
        $this->call(Faqs::class);
        $this->call(Jobsdirectory::class);
        $this->call(Post::class);
        $this->call(Secret::class);
        $this->call(WorkingHours::class);

}

}
