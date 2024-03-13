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
            'base_id' => '01_1st',
            'base_name' => '第1営業所',
        ]);
        Base::create([
            'base_id' => '02_2nd',
            'base_name' => '第2営業所',
        ]);
        Base::create([
            'base_id' => '03_3rd',
            'base_name' => '第3営業所',
        ]);
        Base::create([
            'base_id' => '05_LS',
            'base_name' => 'ロジステーション',
        ]);
        Base::create([
            'base_id' => '06_LP',
            'base_name' => 'ロジポート',
        ]);
        Base::create([
            'base_id' => '08_LC',
            'base_name' => 'ロジコンタクト',
        ]);
        Base::create([
            'base_id' => '09_LSP',
            'base_name' => 'ロジステーションプラス',
        ]);
        Base::create([
            'base_id' => '07_Hiroshima	',
            'base_name' => '広島営業所',
        ]);
    }
}
