<?php

use Illuminate\Database\Seeder;

class TagCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tag_categories')->truncate();
        DB::table('tag_categories')->insert([
            [
                'name' => '犬',
            ],
            [
                'name' => '猫',
            ],
            [
                'name' => 'ハムスター',
            ],
            [
                'name' => 'カメ',
            ],
            [
                'name' => 'その他',
            ],
        ]);
    }
}
