<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CustomerTag;

class CustomerTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomerTag::create([
            'customer_code' => 'ark',
            'tag_id' => 1,
        ]);
        CustomerTag::create([
            'customer_code' => 'roe',
            'tag_id' => 1,
        ]);
        CustomerTag::create([
            'customer_code' => 'ark',
            'tag_id' => 2,
        ]);
        CustomerTag::create([
            'customer_code' => 'roe',
            'tag_id' => 2,
        ]);
        CustomerTag::create([
            'customer_code' => 'intervia_btob',
            'tag_id' => 2,
        ]);
        CustomerTag::create([
            'customer_code' => 'intervia_btoc',
            'tag_id' => 2,
        ]);
        CustomerTag::create([
            'customer_code' => 'intervia_btoc',
            'tag_id' => 3,
        ]);
        CustomerTag::create([
            'customer_code' => 'hodaka_btoc',
            'tag_id' => 3,
        ]);
        CustomerTag::create([
            'customer_code' => 'ark',
            'tag_id' => 3,
        ]);
        CustomerTag::create([
            'customer_code' => 'roe',
            'tag_id' => 3,
        ]);
    }
}
