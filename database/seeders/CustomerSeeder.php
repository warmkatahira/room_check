<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::create([
            'customer_code' => 'intervia_btob',
            'customer_name' => 'intervia(卸)',
            'base_id' => 1,
        ]);
        Customer::create([
            'customer_code' => 'intervia_btoc',
            'customer_name' => 'intervia(通販)',
            'base_id' => 1,
        ]);
        Customer::create([
            'customer_code' => 'ark',
            'customer_name' => 'アーク',
            'base_id' => 1,
        ]);
        Customer::create([
            'customer_code' => 'roe',
            'customer_name' => 'ROE',
            'base_id' => 1,
        ]);
        Customer::create([
            'customer_code' => 'hodaka_btoc',
            'customer_name' => 'ホダカ(通販)',
            'base_id' => 3,
        ]);
    }
}
