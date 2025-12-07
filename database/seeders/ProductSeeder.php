<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'category_id' => 1,
            'name' => 'Keyboard Mechanical',
            'price' => 500000,
            'stock' => 10,
            'image' => 'keyboard.jpg',
            'description' => 'Keyboard mechanical RGB',
        ]);

        Product::create([
            'category_id' => 1,
            'name' => 'Mouse Gaming',
            'price' => 250000,
            'stock' => 20,
            'image' => 'mouse.jpg',
            'description' => 'Mouse DPI tinggi',
        ]);
    }
}
