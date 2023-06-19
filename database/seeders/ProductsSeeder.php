<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Product 1',
                'price' => 1.000,
                'stock' => 100,
                'new_stock' => 100,
                'description' => 'Description for Product 1',
                'tags' => 'tag1',
                'is_available' => 1,
                'categories_id' => 1,
            ],
            [
                'name' => 'Product 2',
                'price' => 1.000,
                'stock' => 50,
                'new_stock' => 20,
                'description' => 'Description for Product 2',
                'tags' => 'tag3',
                'is_available' => 1,
                'categories_id' => 2,
            ],
            // Tambahkan data produk lainnya di sini
        ];

        foreach ($products as $product) {
            Produk::create($product);
        }
    }
}
