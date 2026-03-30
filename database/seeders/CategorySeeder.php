<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name'        => 'Category 1',
                'slug'        => 'category-1',
                'description' => 'This is category 1.',
                'image'       => null,
            ],
            [
                'name'        => 'Category 2',
                'slug'        => 'category-2',
                'description' => 'This is category 2.',
                'image'       => null,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
