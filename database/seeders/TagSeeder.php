<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create([
            'tag_name' => 'ELM',
            'tag_sort_order' => 1,
        ]);
        Tag::create([
            'tag_name' => 'カラコン',
            'tag_sort_order' => 2,
        ]);
        Tag::create([
            'tag_name' => '通販',
            'tag_sort_order' => 3,
        ]);
    }
}
