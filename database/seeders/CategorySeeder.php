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
                'image'       => 'https://images.unsplash.com/photo-1507582020471-1633a6b6f07b?w=600&h=600&fit=crop',
            ],
            [
                'name'        => 'Training',
                'slug'        => 'training',
                'description' => 'Comprehensive training programs and certification courses for professional development. Master new skills with our expert-led training modules.',
                'image'       => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=600&h=600&fit=crop',
            ],
            [
                'name'        => 'Military Support',
                'slug'        => 'military-support',
                'description' => 'Specialized equipment and support systems for military and defense operations worldwide. High-performance solutions for demanding applications.',
                'image'       => 'https://images.unsplash.com/photo-1576516229904-97176b24d078?w=600&h=600&fit=crop',
            ],
            [
                'name'        => 'Cars',
                'slug'        => 'cars',
                'description' => 'Premium automotive vehicles and accessories. Discover luxury cars, performance vehicles, and essential automotive equipment.',
                'image'       => 'https://images.unsplash.com/photo-1552820728-8ac41f1ce891?w=600&h=600&fit=crop',
            ],
            [
                'name'        => 'Fashion & Clothing',
                'slug'        => 'fashion-clothing',
                'description' => 'Curated collection of fashion, apparel, and clothing from top brands worldwide. Stay stylish with our exclusive selection.',
                'image'       => 'https://images.unsplash.com/photo-1594938298603-c8148c4dae35?w=600&h=600&fit=crop',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
