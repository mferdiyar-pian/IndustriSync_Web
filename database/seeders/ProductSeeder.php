<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'category_id' => 1,
                'name' => 'Smartphone X1',
                'slug' => 'smartphone-x1',
                'description' => 'Smartphone canggih dengan RAM 8GB.',
                'price' => 5000000,
                'stock' => 50,
            ],
            [
                'category_id' => 3,
                'name' => 'Kopi Robusta',
                'slug' => 'kopi-robusta',
                'description' => 'Kopi asli Lampung 250gr.',
                'price' => 45000,
                'stock' => 10, // Low stock for testing alert
            ],
        ];

        foreach ($products as $product) {
            \App\Models\Product::create($product);
        }
    }
}
