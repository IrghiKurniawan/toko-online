<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Handphone & Aksesoris']);
        Category::create(['name' => 'Laptop & Aksesoris']);
        Category::create(['name' => 'Komputer / Komponen']);
        Category::create(['name' => 'Kamera']);
        Category::create(['name' => 'Audio (headset, speaker)']);
    }
}
