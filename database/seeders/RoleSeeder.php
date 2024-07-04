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
            'master_operation_is_available' => 1,
            'management_operation_is_available' => 1,
        ]);
        Role::create([
            'role_name' => '田村',
            'master_operation_is_available' => 1,
        ]);
        Role::create([
            'role_name' => '一般',
        ]);
    }
}
