<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'category_id'       => 1,
                'name'              => 'Product 1',
                'slug'              => 'product-1',
                'short_description' => 'Short description for product 1.',
                'description'       => 'Full description for product 1.',
                'price'             => 29.99,
                'sale_price'        => null,
                'stock'             => 10,
                'image'             => null,
                'featured'          => true,
                'status'            => 'active',
            ],
            [
                'category_id'       => 2,
                'name'              => 'Product 2',
                'slug'              => 'product-2',
                'short_description' => 'Short description for product 2.',
                'description'       => 'Full description for product 2.',
                'price'             => 49.99,
                'sale_price'        => 39.99,
                'stock'             => 5,
                'image'             => null,
                'featured'          => false,
                'status'            => 'active',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
