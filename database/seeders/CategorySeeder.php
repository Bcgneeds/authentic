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
                'name'        => 'Drones',
                'slug'        => 'drones',
                'description' => 'Advanced drone technology for commercial, industrial, and professional applications. Browse our selection of cutting-edge unmanned aerial vehicles.',
                'image'       => null,
            ],
            [
                'name'        => 'Training',
                'slug'        => 'training',
                'description' => 'Comprehensive training programs and certification courses for professional development. Master new skills with our expert-led training modules.',
                'image'       => null,
            ],
            [
                'name'        => 'Military Support',
                'slug'        => 'military-support',
                'description' => 'Specialized equipment and support systems for military and defense operations worldwide. High-performance solutions for demanding applications.',
                'image'       => null,
            ],
            [
                'name'        => 'Cars',
                'slug'        => 'cars',
                'description' => 'Premium automotive vehicles and accessories. Discover luxury cars, performance vehicles, and essential automotive equipment.',
                'image'       => null,
            ],
            [
                'name'        => 'Fashion & Clothing',
                'slug'        => 'fashion-clothing',
                'description' => 'Curated collection of fashion, apparel, and clothing from top brands worldwide. Stay stylish with our exclusive selection.',
                'image'       => null,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
