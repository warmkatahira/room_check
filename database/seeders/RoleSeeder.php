<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'role_name' => 'システム管理者',
            'role_operation_is_available' => 1,
            'user_operation_is_available' => 1,
            'base_operation_is_available' => 1,
            'customer_operation_is_available' => 1,
            'item_operation_is_available' => 1,
        ]);
        Role::create([
            'role_name' => '一般',
        ]);
    }
}
