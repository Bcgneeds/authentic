<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            // Drones Category (ID: 1)
            [
                'category_id'       => 1,
                'name'              => 'Professional Quad Drone',
                'slug'              => 'professional-quad-drone',
                'short_description' => 'High-performance quadcopter with 4K camera.',
                'description'       => 'Professional-grade quadcopter drone equipped with advanced stabilization, 4K camera, and extended flight time for commercial applications.',
                'price'             => 1299.99,
                'sale_price'        => null,
                'stock'             => 15,
                'image'             => 'https://images.unsplash.com/photo-1507004957056-9114ad5e20f9?w=800&h=800&fit=crop',
                'featured'          => false,
                'status'            => 'active',
            ],
            [
                'category_id'       => 1,
                'name'              => 'Compact Drone Starter Kit',
                'slug'              => 'compact-drone-starter-kit',
                'short_description' => 'Entry-level drone perfect for beginners.',
                'description'       => 'Lightweight and portable drone ideal for learning flight basics with included carrying case and spare batteries.',
                'price'             => 399.99,
                'sale_price'        => 349.99,
                'stock'             => 25,
                'image'             => 'https://images.unsplash.com/photo-1521453755456-281cf4e8ee00?w=800&h=800&fit=crop',
                'featured'          => true,
                'status'            => 'active',
            ],

            // Training Category (ID: 2)
            [
                'category_id'       => 2,
                'name'              => 'Advanced Pilot Certification',
                'slug'              => 'advanced-pilot-certification',
                'short_description' => 'Comprehensive pilot training program.',
                'description'       => 'Complete certification course covering advanced flight techniques, safety protocols, and commercial operations.',
                'price'             => 599.99,
                'sale_price'        => null,
                'stock'             => 50,
                'image'             => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=800&fit=crop',
                'featured'          => false,
                'status'            => 'active',
            ],
            [
                'category_id'       => 2,
                'name'              => 'Safety & Operations Seminar',
                'slug'              => 'safety-operations-seminar',
                'short_description' => 'Professional development training course.',
                'description'       => 'Intensive seminar on operational safety, risk management, and industry best practices.',
                'price'             => 299.99,
                'sale_price'        => 249.99,
                'stock'             => 30,
                'image'             => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=800&h=800&fit=crop',
                'featured'          => false,
                'status'            => 'active',
            ],

            // Military Support Category (ID: 3)
            [
                'category_id'       => 3,
                'name'              => 'Tactical Detection System',
                'slug'              => 'tactical-detection-system',
                'short_description' => 'Advanced surveillance and detection equipment.',
                'description'       => 'Military-grade detection system with enhanced capabilities for defense and security operations.',
                'price'             => 4999.99,
                'sale_price'        => null,
                'stock'             => 8,
                'image'             => 'https://images.unsplash.com/photo-1576516229904-97176b24d078?w=800&h=800&fit=crop',
                'featured'          => false,
                'status'            => 'active',
            ],
            [
                'category_id'       => 3,
                'name'              => 'Professional Communication Unit',
                'slug'              => 'professional-communication-unit',
                'short_description' => 'Secure military communications equipment.',
                'description'       => 'Encrypted communication systems designed for critical military and defense operations worldwide.',
                'price'             => 3499.99,
                'sale_price'        => 3199.99,
                'stock'             => 12,
                'image'             => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800&h=800&fit=crop',
                'featured'          => false,
                'status'            => 'active',
            ],

            // Cars Category (ID: 4)
            [
                'category_id'       => 4,
                'name'              => 'Luxury Sedan Vehicle',
                'slug'              => 'luxury-sedan-vehicle',
                'short_description' => 'Premium luxury sedan with advanced features.',
                'description'       => 'Elegant luxury sedan combining performance, comfort, and cutting-edge technology. Featuring premium materials and advanced safety systems.',
                'price'             => 79999.99,
                'sale_price'        => null,
                'stock'             => 5,
                'image'             => 'https://images.unsplash.com/photo-1567818735868-e71b99932e29?w=800&h=800&fit=crop',
                'featured'          => false,
                'status'            => 'active',
            ],
            [
                'category_id'       => 4,
                'name'              => 'Performance SUV',
                'slug'              => 'performance-suv',
                'short_description' => 'High-performance sport utility vehicle.',
                'description'       => 'Dynamic SUV with enhanced performance capabilities, superior handling, and spacious luxurious interior.',
                'price'             => 64999.99,
                'sale_price'        => 59999.99,
                'stock'             => 8,
                'image'             => 'https://images.unsplash.com/photo-1605559424843-9e4c3ff86dca?w=800&h=800&fit=crop',
                'featured'          => false,
                'status'            => 'active',
            ],
            [
                'category_id'       => 4,
                'name'              => 'Car Maintenance Kit',
                'slug'              => 'car-maintenance-kit',
                'short_description' => 'Professional automotive maintenance supplies.',
                'description'       => 'Complete maintenance kit with essential tools and products for vehicle care and upkeep.',
                'price'             => 149.99,
                'sale_price'        => 119.99,
                'stock'             => 40,
                'image'             => 'https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?w=800&h=800&fit=crop',
                'featured'          => true,
                'status'            => 'active',
            ],

            // Fashion & Clothing Category (ID: 5)
            [
                'category_id'       => 5,
                'name'              => 'Designer Formal Collection',
                'slug'              => 'designer-formal-collection',
                'short_description' => 'Premium formal wear from top designers.',
                'description'       => 'Sophisticated formal attire collection crafted from premium materials. Perfect for elegant occasions and professional events.',
                'price'             => 899.99,
                'sale_price'        => null,
                'stock'             => 20,
                'image'             => 'https://images.unsplash.com/photo-1591195853828-11db59a44f6b?w=800&h=800&fit=crop',
                'featured'          => false,
                'status'            => 'active',
            ],
            [
                'category_id'       => 5,
                'name'              => 'Casual Wear Essentials',
                'slug'              => 'casual-wear-essentials',
                'short_description' => 'Comfortable everyday clothing collection.',
                'description'       => 'Curated selection of versatile casual wear combining comfort with contemporary style for everyday elegance.',
                'price'             => 49.99,
                'sale_price'        => 34.99,
                'stock'             => 75,
                'image'             => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=800&h=800&fit=crop',
                'featured'          => true,
                'status'            => 'active',
            ],
            [
                'category_id'       => 5,
                'name'              => 'Premium Footwear Line',
                'slug'              => 'premium-footwear-line',
                'short_description' => 'Exclusive designer shoes and boots.',
                'description'       => 'High-quality footwear featuring signature designs from leading fashion brands worldwide.',
                'price'             => 299.99,
                'sale_price'        => 249.99,
                'stock'             => 35,
                'image'             => 'https://images.unsplash.com/photo-1543163521-9145f93205e6?w=800&h=800&fit=crop',
                'featured'          => false,
                'status'            => 'active',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
