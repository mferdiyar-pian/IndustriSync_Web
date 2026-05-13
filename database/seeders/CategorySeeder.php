<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik', 'slug' => 'elektronik'],
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Makanan & Minuman', 'slug' => 'makanan-minuman'],
            ['name' => 'Alat Tulis', 'slug' => 'alat-tulis'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
