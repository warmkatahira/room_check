<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::create([
            'item_code' => 'shipment_order_quantity',
            'item_name' => '出荷数',
            'item_unit' => '件',
            'item_sort_order' => 1,
        ]);
        Item::create([
            'item_code' => 'inspection_incomplete_shipment_order_quantity',
            'item_name' => '出荷検品残数',
            'item_unit' => '件',
            'item_sort_order' => 2,
        ]);
        Item::create([
            'item_code' => 'shipment_quantity_pcs',
            'item_name' => '出荷数',
            'item_unit' => 'PCS',
            'item_sort_order' => 3,
        ]);
        Item::create([
            'item_code' => 'inspection_incomplete_shipment_quantity_pcs',
            'item_name' => '出荷検品残数',
            'item_unit' => 'PCS',
            'item_sort_order' => 4,
        ]);
        Item::create([
            'item_code' => 'shipment_quantity_cs',
            'item_name' => '出荷数',
            'item_unit' => 'C/S',
            'item_sort_order' => 5,
        ]);
        Item::create([
            'item_code' => 'inspection_incomplete_shipment_quantity_cs',
            'item_name' => '出荷検品残数',
            'item_unit' => 'C/S',
            'item_sort_order' => 6,
        ]);
    }
}
