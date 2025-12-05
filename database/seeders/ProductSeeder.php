<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'category_id' => 1,
            'name' => 'Ayam Goreng',
            'price' => 5000,
            'stock' => 10,
            'image' => 'ayam.jpg',
            'description' => 'ayam goreng enak',
        ]);
    }
}
