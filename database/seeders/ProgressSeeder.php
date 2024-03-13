<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Progress;
// その他
use Carbon\CarbonImmutable;

class ProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Progress::create([
            'customer_code' => 'intervia_btob',
            'item_code' => 'shipment_order_quantity',
            'progress_value' => 120,
        ]);
        Progress::create([
            'customer_code' => 'intervia_btob',
            'item_code' => 'inspection_incomplete_shipment_order_quantity',
            'progress_value' => 109,
        ]);
        Progress::create([
            'customer_code' => 'intervia_btoc',
            'item_code' => 'shipment_order_quantity',
            'progress_value' => 27,
        ]);
        Progress::create([
            'customer_code' => 'intervia_btoc',
            'item_code' => 'shipment_quantity_pcs',
            'progress_value' => 1030,
        ]);
        Progress::create([
            'customer_code' => 'intervia_btoc',
            'item_code' => 'inspection_incomplete_shipment_quantity_pcs',
            'progress_value' => 220,
        ]);
        Progress::create([
            'customer_code' => 'hodaka_btoc',
            'item_code' => 'shipment_order_quantity',
            'progress_value' => 4,
        ]);
        Progress::create([
            'customer_code' => 'ark',
            'item_code' => 'shipment_order_quantity',
            'progress_value' => 100,
        ]);
        Progress::create([
            'customer_code' => 'roe',
            'item_code' => 'shipment_order_quantity',
            'progress_value' => 22,
        ]);
        Progress::create([
            'customer_code' => 'roe',
            'item_code' => 'inspection_incomplete_shipment_order_quantity',
            'progress_value' => 4,
        ]);
    }
}
