<?php

use App\Models\Post_Prefecture;
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
        $this->call([
            UsersTableSeeder::class,
            PostsTableSeeder::class,
            TagCategoriesSeeder::class,
            PrefecturesSeeder::class,
            PostPrefecturesSeeder::class
        ]);
    }
}
