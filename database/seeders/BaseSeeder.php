<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Base;

class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Base::create([
            'base_name' => '第1営業所',
            'base_sort_order' => 1,
        ]);
        Base::create([
            'base_name' => '第2営業所',
            'base_sort_order' => 2,
        ]);
        Base::create([
            'base_name' => '第3営業所',
            'base_sort_order' => 3,
        ]);
    }
}
