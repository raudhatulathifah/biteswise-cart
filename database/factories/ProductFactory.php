<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state with different values.
     *
     * @return array
     */
    public function definition()
    {
        $products = [
            ['nama_produk' => 'Sop Ayam', 'harga' => 20000, 'stok_produk' => 20, 'berat' => 100, 'kalori' => 200],
            ['nama_produk' => 'Salad Buah', 'harga' => 15000, 'stok_produk' => 15, 'berat' => 200, 'kalori' => 250],
            ['nama_produk' => 'Salad Sayur', 'harga' => 22000, 'stok_produk' => 10, 'berat' => 240.5, 'kalori' => 100],
            ['nama_produk' => 'Rawon', 'harga' => 38000, 'stok_produk' => 5,  'berat' => 500, 'kalori' => 500],
            ['nama_produk' => 'Sate Ayam', 'harga' => 15000, 'stok_produk' => 8,  'berat' => 200, 'kalori' => 150],
        ];

        static $index = 0;

        // Return each product one by one for each call to the factory
        return array_merge($products[$index++ % count($products)], [
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
