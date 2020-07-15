<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->truncate();
        DB::table('users')->insert([
            [
                'name'       => 'マイケル',
                'email'      => 'hoge@gmail.com',
                'prefecture_id' => 7,
                'gender'     => '男性',
                'password'   => Hash::make('password'),
                'created_at' => Carbon::create(2020, 06, 01)
            ],
            [
                'name'       => 'ミッシェル',
                'email'      => 'foo@gmail.com',
                'prefecture_id' => 20,
                'gender'     => '女性',
                'password'   => Hash::make('password'),
                'created_at' => Carbon::create(2020, 06, 03)
            ],
            [
                'name'       => 'ジョエル',
                'email'      => 'joel@gmail.com',
                'prefecture_id' => 28,
                'gender'     => '男性',
                'password'   => Hash::make('password'),
                'created_at' => Carbon::create(2020, 06, 06)
            ],
            [
                'name'       => 'ダニエル',
                'email'      => 'dani@gmail.com',
                'prefecture_id' => 33,
                'gender'     => '男性',
                'password'   => Hash::make('password'),
                'created_at' => Carbon::create(2020, 06, 10)
            ],
            [
                'name'       => '田中太郎',
                'email'      => 'tanaka@gmail.com',
                'prefecture_id' => 40,
                'gender'     => '男性',
                'password'   => Hash::make('password'),
                'created_at' => Carbon::create(2020, 06, 10)
            ],
            [
                'name'       => 'ゲスト',
                'email'      => 'guest@guest.com',
                'prefecture_id' => 20,
                'gender'     => '男性',
                'password'   => Hash::make('password'),
                'created_at' => Carbon::create(2020, 06, 10)
            ],
            
        ]);
    }
}
