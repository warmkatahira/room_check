<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_id' => 'katahira',
            'user_name' => '片平 貴順',
            'password' => bcrypt('katahira134'),
            'role_id' => 1,
            'status' => 1,
        ]);
        User::create([
            'user_id' => 'tamura',
            'user_name' => '田村 拓海',
            'password' => bcrypt('tamura135'),
            'role_id' => 1,
            'status' => 1,
        ]);
        User::create([
            'user_id' => 'user',
            'user_name' => '共通ユーザー',
            'password' => bcrypt('user12345'),
            'role_id' => 2,
            'status' => 1,
        ]);
    }
}
