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
                'email' => 'test@yahoo.co.jp',
                'profile' => 'サイト管理者のぱたおです！よろしく！',
                'password' => Hash::make('password'),
                'created_at' => '2021/02/02 11:11:11',
                'updated_at' => '2021/02/02 11:11:11'
            ],
            [
                'name' => 'ぱたこ',
                'email' => 'test1@test.co.jp',
                'profile' => 'プロフィール、プロフィール、プロフィール、プロフィール、プロフィール',
                'password' => Hash::make('password'),
                'created_at' => '2021/02/02 11:11:11',
                'updated_at' => '2021/02/02 11:11:11'
            ],

        ]);
    }
}
