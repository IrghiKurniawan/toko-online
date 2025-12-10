<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'category_id' => 6,
            'name' => 'Keyboard Mechanical',
            'price' => 500000,
            'stock' => 10,
            'image' => 'keyboard.jpg',
            'description' => 'Keyboard mechanical RGB',
        ]);

        Product::create([
            'category_id' => 6,
            'name' => 'Mouse Gaming',
            'price' => 250000,
            'stock' => 20,
            'image' => 'mouse.png',
            'description' => 'Mouse DPI tinggi',
        ]);
        Product::create([
            'category_id' => 6,
            'name' => 'Monitor 24 inch',
            'price' => 1500000,
            'stock' => 5,
            'image' => 'monitor.jpg',
            'description' => 'Monitor Full HD',
        ]);
    }
}
