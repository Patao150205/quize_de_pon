<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'ぱたお',
                'email' => 'test1@test.co.jp',
                'profile' => 'プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'ぱたこ',
                'email' => 'test2@test.co.jp',
                'profile' => 'プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、プロフィール、',
                'password' => Hash::make('password'),
            ],

        ]);
    }
}
